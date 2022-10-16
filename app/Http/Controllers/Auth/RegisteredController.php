<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class RegisteredController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.registered');
    }

    public function store(RegisteredRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(40)
        ]);

        if ($user) {
            event(new Registered($user));

            auth('web')->login($user);

            return to_route('verification.notice');
        }

        return to_route('login')->with('success', __('auth.success_registered'));
    }
}
