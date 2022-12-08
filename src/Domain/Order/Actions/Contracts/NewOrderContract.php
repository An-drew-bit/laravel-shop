<?php

namespace Domain\Order\Actions\Contracts;

use Domain\Order\DTO\OrderCustomerDTO;
use Domain\Order\DTO\OrderDTO;
use Domain\Order\Models\Order;

interface NewOrderContract
{
    public function __invoke(OrderDTO $data, OrderCustomerDTO $customer, bool $createAccount): Order;
}
