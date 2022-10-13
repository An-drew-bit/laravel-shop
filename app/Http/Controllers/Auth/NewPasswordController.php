<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\NewPasswordRequest;
use App\Http\Requests\Auth\ReestablishRequest;
use App\Queries\UserBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.reestablish');
    }

    public function update(NewPasswordRequest $request): RedirectResponse
    {
        $request->user()->forceFill([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60)
        ])->save();

        return to_route('')->with('success', trans('passwords.reset'));
    }

    public function reestablish(ReestablishRequest $request, UserBuilder $builder): RedirectResponse
    {
        $user = $builder->getUserByEmail($request->email);

        $user->password = bcrypt($request->password);
        $user->save();

        return to_route('home')->with('success', trans('passwords.reset'));
    }
}
