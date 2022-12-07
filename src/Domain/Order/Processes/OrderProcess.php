<?php

namespace Domain\Order\Processes;

use Domain\Order\Events\OrderCreated;
use Domain\Order\Models\Order;
use DomainException;
use Illuminate\Pipeline\Pipeline;
use Support\Transaction;
use Throwable;

final class OrderProcess
{
    protected array $processes = [];

    public function __construct(
        protected Order $order
    ){
    }

    public function processes(array $processes): self
    {
        $this->processes = $processes;

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function run(): Order
    {
        return Transaction::run(function () {
            return app(Pipeline::class)
                ->send($this->order)
                ->through($this->processes)
                ->thenReturn();

        }, function (Order $order) {
            flash()->info("Congratulations, order #{$order->id} created");

            event(new OrderCreated($order));

        }, function (Throwable $exception) {
            if (!app()->isLocal()) {
                throw new DomainException('Что то пошло не так, попробуйте позже');
            }

            throw new DomainException($exception->getMessage());
        });
    }
}
