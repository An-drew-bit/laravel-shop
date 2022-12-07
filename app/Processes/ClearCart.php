<?php

namespace App\Processes;

use App\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;

final class ClearCart implements OrderProcessContract
{
    public function handle(Order $order, $next): mixed
    {
        cart()->truncate();

        return $next($order);
    }
}
