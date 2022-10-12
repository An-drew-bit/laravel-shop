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

class RegisteredController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('');
    }

    public function store(RegisteredRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            //event(new Registered($user));

            auth('web')->login($user);

            return to_route('');
        }

        return to_route('')->with(trans('auth.success_registered'));
    }
}
