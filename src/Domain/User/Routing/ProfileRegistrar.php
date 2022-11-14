<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class ProfileRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::controller(ProfileController::class)->middleware(['web', 'auth'])->group(function () {
            Route::get('/profile/{user}/edit', 'edit')->name('profile.edit');
            Route::put('/profile/update', 'update')->name('profile.update');
        });
    }
}
