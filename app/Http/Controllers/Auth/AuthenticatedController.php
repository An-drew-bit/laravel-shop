<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Support\SessionRegenerator;

class AuthenticatedController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.login-mail');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        flash()->info(__('auth.success_login'));

        return to_route('home');
    }

    public function logout(): RedirectResponse
    {
        SessionRegenerator::run(fn() => auth()->logout());

        flash()->info(__('auth.success_logout'));

        return to_route('home');
    }
}
