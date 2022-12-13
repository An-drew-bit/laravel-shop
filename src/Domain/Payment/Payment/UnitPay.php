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
        // TODO: Implement configure() method.
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
        // TODO: Implement url() method.
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.
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
