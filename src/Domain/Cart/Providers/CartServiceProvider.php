<?php

namespace Domain\Cart\Providers;

use App\Contracts\CartIdentityStorage;
use Domain\Cart\CartManager;
use Domain\Cart\StorageIdentities\SessionIdentitiesStorage;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );

        $this->app->bind(CartIdentityStorage::class, SessionIdentitiesStorage::class);

        $this->app->singleton(CartManager::class);
    }

    public function boot(): void
    {

    }
}
