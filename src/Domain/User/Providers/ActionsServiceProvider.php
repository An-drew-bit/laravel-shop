<?php

namespace Domain\User\Providers;

use Domain\User\Actions\RegisteredActions;
use Domain\User\Actions\Contract\RegisteredContract;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        RegisteredContract::class => RegisteredActions::class,
    ];
}
