<?php

namespace Domain\Payment\Payment;

use Domain\Payment\Payment\Contract\PaymentGatewayContract;
use Domain\Payment\PaymentData;
use Illuminate\Http\JsonResponse;
use Services\UnitPay\UnitPayPayment;

final class UnitPay implements PaymentGatewayContract
{
    protected UnitPayPayment $client;

    protected PaymentData $paymentData;

    protected string $errorMessage;

    public function __construct(array $config)
    {
        $this->configure($config);
    }

    public function paymentId(): string
    {
        return $this->paymentData->getId();
    }

    public function configure(array $config): void
    {
        $this->client = new UnitPayPayment(...$config);
    }

    public function data(PaymentData $data): PaymentGatewayContract
    {
        $this->paymentData = $data;

        return $this;
    }

    public function request(): array
    {
        return request()->all();
    }

    public function response(): JsonResponse
    {
        return response()->json(
            $this->client->response()
        );
    }

    public function url(): string
    {
        return $this->client->createPayment(
            $this->paymentData->getId(),
            $this->paymentData->getAmount()->value(),
            $this->paymentData->getDescription(),
            $this->paymentData->getAmount()->currency(),
            [
                $this->client->cahsItem(
                    $this->paymentData->getDescription(),
                    1,
                    $this->paymentData->getAmount()->value(),
                ),
            ],
            $this->paymentData->getMeta()->get('email', ''),
            $this->paymentData->getReturnUrl(),
            $this->paymentData->getReturnUrl(),
            $this->paymentData->getMeta()->get('phone', ''),
        );
    }

    public function validate(): bool
    {
        return $this->client->handle(
            $this->paymentData->getAmount()->value(),
            $this->paymentData->getAmount()->currency(),
        )
            ->isPaySuccess();
    }

    public function paid(): bool
    {
        return $this->client->isPaySuccess();
    }

    public function errorMessage(): string
    {
        return $this->client->errorMessage();
    }
}
