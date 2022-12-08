<?php

namespace Domain\Order\DTO;

use Support\Traits\Makeable;

final class OrderDTO
{
    use Makeable;

    public function __construct(
        public readonly int $payment_method_id,
        public readonly int $delivery_type_id,
        public readonly ?string $password = null,
    ){
    }
}
