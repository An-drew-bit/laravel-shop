<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Domain\Payment\Payment;
use Domain\Payment\PaymentData;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class PurchaseController extends Controller
{
    public function index(): Redirector|Application|RedirectResponse
    {
        return redirect(
            Payment::create(new PaymentData())
                ->url()
        );
    }

    public function callback(): JsonResponse
    {
        return Payment::validate()
            ->response();
    }
}
