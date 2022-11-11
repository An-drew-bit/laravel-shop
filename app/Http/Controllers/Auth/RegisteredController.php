<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use Domain\User\Actions\Contract\RegisteredContract;
use Domain\User\DTO\NewUserDTO;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegisteredController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.registered');
    }

    public function store(RegisteredRequest $request, RegisteredContract $contract): RedirectResponse
    {
        $contract(NewUserDTO::formRequest($request));

        flash()->info(__('auth.success_registered'));

        return to_route('verification.notice');
    }
}
