<?php

namespace Domain\Payment\Providers;

use Domain\Payment\Payment;
use Domain\Payment\Payment\UnitPay;
use Domain\Payment\Payment\YooKassa;
use Illuminate\Support\ServiceProvider;
use Domain\Payment\Models\Payment as PaymentModel;
use Psr\Log\LogLevel;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Payment::provider(function () {
            if (request()->has('unitpay')) {
                return new UnitPay(config('payment.providers.unitpay'));
            }

            return new YooKassa(config('payment.providers.yookassa'));
        });

        Payment::onCreating(function (PaymentModel $payment) {
            logger()->log(LogLevel::NOTICE, 'payment created', [$payment->meta]);
        });

        Payment::onSuccess(function (PaymentModel $payment) {
            logger()->log(LogLevel::NOTICE, 'payment success', [$payment->meta]);
        });

        Payment::onError(function (PaymentModel $payment, string $message) {
            logger()->log(LogLevel::ERROR, 'payment on error', [
                'meta' => $payment->meta,
                'message' => $message,
            ]);
        });
    }
}
