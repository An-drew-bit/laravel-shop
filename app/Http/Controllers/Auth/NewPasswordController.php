<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\NewPasswordRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('');
    }

    public function update(NewPasswordRequest $request): RedirectResponse
    {
        $request->user()->forceFill([
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60)
        ])->save();

        return to_route('')->with('success', trans('passwords.reset'));
    }
}
