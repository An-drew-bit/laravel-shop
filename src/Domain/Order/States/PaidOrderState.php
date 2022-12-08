<?php

namespace Domain\Order\States;

use Domain\Order\Enums\OrderStatus;

final class PaidOrderState extends OrderState
{
    protected array $allowedTransitions = [
        CancelledOrderState::class,
    ];

    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): OrderStatus
    {
        return OrderStatus::Paid;
    }

    public function uiValue(): string
    {
        return __('order-state.paid');
    }
}
