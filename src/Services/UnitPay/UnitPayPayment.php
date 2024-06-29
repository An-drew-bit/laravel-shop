<?php

namespace Services\UnitPay;

use Illuminate\Http\JsonResponse;

final class UnitPayPayment
{
    public function __construct(
        public string $publicKey,
        public string $secretKey,
        public string $domain = 'unitpay.ru',
    ) {
    }

    public function createPayment(): string
    {
    }

    public function cahsItem()
    {
    }

    public function handle(int $value, string $currency): self
    {
        return $this;
    }

    public function response(): JsonResponse
    {
    }

    public function isPaySuccess(): bool
    {
    }

    public function errorMessage(): string
    {
    }
}
