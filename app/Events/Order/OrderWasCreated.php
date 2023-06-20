<?php

namespace App\Events\Order;

use Domain\Order\Enums\OrderStatus;
use Domain\Order\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Order $order
    ) {
    }

    public function isNeedToSendMail(): bool
    {
        return $this->order->status === OrderStatus::New;
    }
}
