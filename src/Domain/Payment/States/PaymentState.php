<?php

declare(strict_types=1);

namespace Domain\Payment\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class PaymentState extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(PendingState::class)
            ->allowTransition(PendingState::class, PaidState::class)
            ->allowTransition(PendingState::class, CancelledState::class);
    }
}
