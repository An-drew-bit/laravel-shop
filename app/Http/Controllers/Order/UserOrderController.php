<?php

namespace App\Http\Controllers\Order;

use Domain\Order\Models\Order;

class UserOrderController
{
    public function index()
    {
        $orders = Order::query()->where('user_id', auth()->id())
            ->get();

        return view('front.order.orders', [
            'orders' => $orders
        ]);
    }
}
