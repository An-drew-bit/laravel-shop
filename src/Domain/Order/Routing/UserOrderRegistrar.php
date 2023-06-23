<?php

namespace Domain\Order\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Order\UserOrderController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class UserOrderRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::controller(UserOrderController::class)->group(function () {

                Route::get('/profile/order')->name('orders.index');
            });
        });
    }
}
