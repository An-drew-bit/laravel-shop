<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderWasCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Order\CreateOrderNotification;

class SendEmailCreatedListener implements ShouldQueue
{
    public function handle(OrderWasCreated $event): void
    {
        if (!$event->isNeedToSendMail()) {
            (new CreateOrderNotification($event->order))
                ->onQueue('default');
        }
    }
}
