<?php

namespace Domain\Order\States;

use Domain\Order\Enums\OrderStatus;

final class PendingOrderState extends OrderState
{
    protected array $allowedTransitions = [
        PaidOrderState::class,
        CancelledOrderState::class,
    ];

    public function canBeChanged(): bool
    {
        return true;
    }

    public function value(): OrderStatus
    {
        return OrderStatus::Pending;
    }

    public function uiValue(): string
    {
        return __('order-state.pending');
    }
}
