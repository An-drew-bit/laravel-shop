<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Socialite\Contract\Social;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialController extends Controller
{
    public function show(): Application|Factory|View
    {
        return view('front.auth.login');
    }

    public function redirect(string $driver): RedirectResponse
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback(Social $social, string $driver): RedirectResponse
    {
        return redirect(
            $social->loginSocial(Socialite::driver($driver)->user())
        );
    }
}
