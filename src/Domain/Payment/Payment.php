<?php

declare(strict_types=1);

namespace Domain\Payment;

use Closure;
use Domain\Payment\Exceptions\PaymentProcessException;
use Domain\Payment\Exceptions\PaymentProviderException;
use Domain\Payment\Models\PaymentHistory;
use Domain\Payment\Payment\Contract\PaymentGatewayContract;
use Domain\Payment\States\PaidState;
use Support\Traits\PaymentEvents;
use Domain\Payment\Models\Payment as PaymentModel;

final class Payment
{
    use PaymentEvents;

    protected static PaymentGatewayContract $provider;

    public static function provider(PaymentGatewayContract|Closure $providerOrClosure): void
    {
        if (is_callable($providerOrClosure)) {
            $providerOrClosure = call_user_func($providerOrClosure);
        }

        if (!$providerOrClosure instanceof PaymentGatewayContract) {
            throw PaymentProviderException::providerRequired();
        }

        self::$provider = $providerOrClosure;
    }

    public static function create(PaymentData $paymentData): PaymentGatewayContract
    {
        if (!self::$provider instanceof PaymentGatewayContract) {
            throw PaymentProviderException::providerRequired();
        }

        PaymentModel::query()->create([
            'payment_id' => $paymentData->getId(),
            'payment_gateway' => get_class(self::$provider),
        ]);

        if (is_callable(self::$onCreating)) {
            $paymentData = call_user_func(self::$onCreating, $paymentData);
        }

        return self::$provider->data($paymentData);
    }

    public static function validate(): PaymentGatewayContract
    {
        if (!self::$provider instanceof PaymentGatewayContract) {
            throw PaymentProviderException::providerRequired();
        }

        PaymentHistory::query()->create([
            'method' => request()->method(),
            'payload' => self::$provider->request(),
            'payment_gateway' => get_class(self::$provider)
        ]);

        if (self::$provider->validate() && self::$provider->paid()) {
            try {
                $payment = PaymentModel::query()
                    ->where('payment_id', self::$provider->paymentId())
                    ->firstOr(fn() => throw PaymentProcessException::paymentNotFound());

                if (is_callable(self::$onSuccess)) {
                    call_user_func(self::$onSuccess, $payment);
                }

                $payment->state->transitionTo(PaidState::class);

            } catch (PaymentProcessException $exception) {
                if (is_callable(self::$onError)) {
                    call_user_func(self::$onError, self::$provider->errorMessage() ?? $exception->getMessage());
                }
            }
        }

        return self::$provider;
    }
}
