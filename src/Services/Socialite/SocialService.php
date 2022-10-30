<?php

namespace Services\Socialite;

use App\Jobs\AuthSocialJob;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Socialite\Contracts\User as SocialUser;
use Services\Socialite\Contract\Social;

final class SocialService implements Social
{
    public function loginSocial(SocialUser $socialUser): string
    {
        $password = str()->random(10);

        try {
            $user = User::updateOrCreate([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'password' => bcrypt($password),
                'email_verified_at' => now(),
            ]);

            dispatch(new AuthSocialJob($user, $password));

            auth()->login($user);

            return url('/');

        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception->getMessage());
        }
    }
}
