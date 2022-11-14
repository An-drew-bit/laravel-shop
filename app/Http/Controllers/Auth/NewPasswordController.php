<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ReestablishRequest;
use Domain\User\Models\User;
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

    public function reestablish(ReestablishRequest $request): RedirectResponse
    {
        $user = User::getByEmail($request->email);

        $user->forceFill([
            'password' => bcrypt($request->password)
        ]);

        $user->save();

        flash()->info(__('passwords.reset'));

        return to_route('login');
    }
}
