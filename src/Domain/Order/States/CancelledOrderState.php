<?php

namespace Domain\Order\States;

final class CancelledOrderState extends OrderState
{
    protected array $allowedTransitions = [];

    public function canBeChanged(): bool
    {
        return false;
    }

    public function value(): string
    {
        return 'cancelled';
    }

    public function uiValue(): string
    {
        return __('order-state.cancelled');
    }
}
