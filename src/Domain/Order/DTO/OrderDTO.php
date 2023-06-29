<?php

namespace Domain\Order\DTO;

use Support\Traits\Makeable;

final class OrderDTO
{
    use Makeable;

    public function __construct(
        private readonly int $payment_method_id,
        private readonly int $delivery_type_id,
        private readonly ?string $password = null,
        private readonly int|float $amount,
    ){
    }

    public function getPaymentMethodId(): int
    {
        return $this->payment_method_id;
    }

    public function getDeliveryTypeId(): int
    {
        return $this->delivery_type_id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getAmount(): float|int
    {
        return $this->amount;
    }
}
