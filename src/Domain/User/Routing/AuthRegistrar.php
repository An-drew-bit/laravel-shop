<?php

namespace Domain\User\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\AuthSocialController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AuthRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')->group(function () {
            Route::middleware('guest')->group(function () {

                Route::controller(RegisteredController::class)->group(function () {
                    Route::get('/registered', 'show')->name('registered');
                    Route::post('/registered', 'store')
                        ->middleware('throttle:auth')
                        ->name('registered.store');
                });

                Route::controller(AuthenticatedController::class)->group(function () {
                    Route::get('/login', 'show')->name('login');
                    Route::post('/login', 'store')
                        ->middleware('throttle:auth')
                        ->name('login.store');
                });

                Route::controller(AuthSocialController::class)->group(function () {
                    Route::get('/auth/social', 'show')->name('social');
                    Route::get('/auth/{driver}/redirect', 'redirect')->name('social.redirect');
                    Route::get('/auth/{driver}/callback', 'callback')->name('social.callback');
                });

                Route::controller(ForgotPasswordController::class)->group(function () {
                    Route::get('/forgot', 'show')->name('forgot');
                    Route::post('/forgot', 'update')->name('forgot.update');
                });

                Route::controller(NewPasswordController::class)->group(function () {
                    Route::get('/reestablish', 'show')->name('reestablish.show');
                    Route::post('/reestablish', 'reestablish')->name('reestablish.reestablish');
                });
            });

            Route::middleware('auth')->group(function () {
                Route::get('/logout', [AuthenticatedController::class, 'logout'])->name('logout');
            });
        });
    }
}
