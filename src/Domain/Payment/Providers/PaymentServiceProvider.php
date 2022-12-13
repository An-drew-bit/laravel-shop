<?php

namespace Domain\Payment\Providers;

use Domain\Payment\Payment;
use Domain\Payment\Payment\UnitPay;
use Domain\Payment\Payment\YooKassa;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Payment::provider(function () {
            if (request()->has('unitpay')) {
                return new UnitPay(config('payment.providers.unitpay'));
            }

            return new YooKassa(config('payment.providers.yookassa'));
        });
    }
}
