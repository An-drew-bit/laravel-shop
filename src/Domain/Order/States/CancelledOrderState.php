<?php

namespace Domain\Order\States;

use Domain\Order\Enums\OrderStatus;

final class CancelledOrderState extends OrderState
{
    protected array $allowedTransitions = [];

    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): OrderStatus
    {
        return OrderStatus::Cancelled;
    }

    public function uiValue(): string
    {
        return __('order-state.cancelled');
    }
}
