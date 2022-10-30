<?php

namespace Domain\User\Actions;

use Domain\User\Actions\Contract\RegisteredContract;
use Domain\User\Models\User;
use Illuminate\Auth\Events\Registered;

final class RegisteredActions implements RegisteredContract
{
    public function handle(string $name, string $email, string $password): void
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        if ($user) {
            event(new Registered($user));

            auth('web')->login($user);
        }
    }
}
