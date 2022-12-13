<?php

namespace Domain\Payment\Payment\Contract;

use Domain\Payment\PaymentData;
use Illuminate\Http\JsonResponse;

interface PaymentGatewayContract
{
    public function paymentId(): string;

    public function configure(array $config): void;

    public function data(PaymentData $data): self;

    public function request(): mixed;

    public function response(): JsonResponse;

    public function url(): string;

    public function validate(): bool;

    public function paid(): bool;

    public function errorMessage(): string;
}
