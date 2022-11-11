<?php

namespace App\Providers;

use Domain\Catalog\Providers\CatalogServiceProvider;
use Illuminate\Support\ServiceProvider;
use Domain\User\Providers\AuthServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(CatalogServiceProvider::class);
    }
}
