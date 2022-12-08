<?php

namespace App\Processes;

use App\Contracts\OrderProcessContract;
use Domain\Order\DTO\OrderCustomerDTO;
use Domain\Order\Models\Order;

final class AssignCustomer implements OrderProcessContract
{
    public function __construct(
        protected OrderCustomerDTO $customer
    ){
    }

    public function handle(Order $order, $next): mixed
    {
        $order->orderCustomer()
            ->create($this->customer->toArray());

        return $next($order);
    }
}
