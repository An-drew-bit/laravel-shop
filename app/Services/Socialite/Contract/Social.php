<?php

namespace App\Services\Socialite\Contract;

use Laravel\Socialite\Contracts\User;

interface Social
{
    public function loginSocial(User $socialUser): string;
}
