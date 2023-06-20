<?php

namespace App\Notifications\Order;

use Domain\Order\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Order $order
    ) {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->subject("Заказ #{$this->order->id} создан")
            ->from(env('MAIL_FROM_ADDRESS'))
            ->bcc(env('MAIL_FROM_ADDRESS'))
            ->replyTo($this->order->orderCustomer->email, $this->getFio())
            ->line("Ваш заказ #{$this->order->id} успешно создан, как он поступит в обработку мы обязательно сообщим");
    }

    private function getFio(): string
    {
        return $this->order->orderCustomer->first_name
            . ' ' .
            $this->order->orderCustomer->last_name;
    }
}
