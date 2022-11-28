<?php

namespace Domain\Cart\Providers;

use App\Contracts\CartIdentityStorage;
use Domain\Cart\StorageIdentities\SessionIdentitiesStorage;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CartIdentityStorage::class => SessionIdentitiesStorage::class,
    ];
}
