<?php

namespace App\Processes;

use App\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

final class AssignCustomer implements OrderProcessContract
{
    public function __construct(
        protected array $data
    ){
    }

    public function handle(Order $order, $next): mixed
    {
        $order->orderCustomer()
            ->create($this->data);

        return $next($order);
    }
}
