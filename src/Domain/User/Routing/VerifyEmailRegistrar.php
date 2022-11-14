<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class VerifyEmailRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', 'guest'])->group(function () {
            Route::controller(VerificationController::class)->group(function () {

                Route::get('/email/verify', 'getVerifyForm')
                    ->middleware('auth')
                    ->name('verification.notice');

                Route::get('/email/verify/{id}/{hash}', 'verifycationRequest')
                    ->middleware(['auth', 'signed'])
                    ->name('verification.verify');

                Route::post('/email/verification-notification', 'repeatSendToMail')
                    ->middleware(['auth', 'throttle:6,1'])
                    ->name('verification.send');
            });
        });
    }
}
