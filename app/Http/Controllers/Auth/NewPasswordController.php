<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ReestablishRequest;
use App\Queries\UserBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NewPasswordController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.reestablish');
    }

    public function reestablish(ReestablishRequest $request, UserBuilder $builder): RedirectResponse
    {
        $user = $builder->getUserByEmail($request->email);

        $user->password = bcrypt($request->password);
        $user->save();

        return to_route('home')->with('success', trans('passwords.reset'));
    }
}
