<?php

namespace App\Http\Controllers\Order;

use Domain\Order\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class UserOrderController
{
    public function __invoke(): Factory|View|Application
    {
        return view('front.order.orders', [
            'orders' => Order::getUserOrder(id: auth()->id()),
        ]);
    }
}
