<?php

declare(strict_types=1);

namespace Domain\Payment;

use Illuminate\Support\Collection;
use Support\ValueObjects\Price;

final class PaymentData
{
    public function __construct(
        protected readonly int $id,
        protected readonly string $description,
        protected readonly string $returnUrl,
        protected readonly Price $amount,
        protected readonly Collection $meta,
    ){
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    public function getAmount(): Price
    {
        return $this->amount;
    }

    public function getMeta(): Collection
    {
        return $this->meta;
    }
}
