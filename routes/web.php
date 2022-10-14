<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::controller(RegisteredController::class)->group(function () {
        Route::get('/registered', 'show')->name('registered');
        Route::post('/registered', 'store')->name('registered.store');
    });

    Route::controller(AuthenticatedController::class)->group(function () {
        Route::get('/login', 'show')->name('login');
        Route::post('/login', 'store')->name('login.store');
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


Route::get('/', function () {
    return view('welcome');
})->name('home');
