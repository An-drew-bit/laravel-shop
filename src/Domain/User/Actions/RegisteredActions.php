<?php

namespace Domain\User\Actions;

use Domain\User\Actions\Contract\RegisteredContract;
use Domain\User\DTO\NewUserDTO;
use Domain\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Support\SessionRegenerator;

final class RegisteredActions implements RegisteredContract
{
    public function __invoke(NewUserDTO $data): void
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password)
        ]);

        event(new Registered($user));

        SessionRegenerator::run(fn() => auth()->login($user));
    }
}
