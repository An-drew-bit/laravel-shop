<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Socialite\Contract\Social;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialController extends Controller
{
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
