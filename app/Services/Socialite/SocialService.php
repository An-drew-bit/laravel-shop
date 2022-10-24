<?php

namespace App\Services\Socialite;

use App\Jobs\AuthSocialJob;
use App\Models\User;
use App\Services\Socialite\Contract\Social;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Socialite\Contracts\User as SocialUser;

final class SocialService implements Social
{
    public function loginSocial(SocialUser $socialUser): string
    {
        $password = 'password';

        try {
            $user = User::updateOrCreate([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt($password),
                'email_verified_at' => now(),
            ]);

            dispatch(new AuthSocialJob($user, $password));

            auth()->login($user);

            return url()->to('/');

        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }
}
