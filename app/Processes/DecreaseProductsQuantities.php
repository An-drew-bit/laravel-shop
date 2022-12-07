<?php

namespace App\Processes;

use App\Contracts\OrderProcessContract;
use Domain\Order\Models\Order;
use Illuminate\Support\Facades\DB;

final class DecreaseProductsQuantities implements OrderProcessContract
{
    public function handle(Order $order, $next): mixed
    {
        foreach (cart()->items() as $item) {
            $item->product()->update([
                'quantity' => DB::raw('quantity - ' . $item->quantity)
            ]);
        }

        return $next($order);
    }
}
