<?php

namespace Domain\Order\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Order\OrderController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class OrderRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::controller(OrderController::class)->group(function () {

                Route::get('/order', 'index')
                    ->name('order');
                Route::post('/order', 'handle')
                    ->name('order.handle');
            });
        });
    }
}
