<?php

namespace Domain\User\Actions\Contract;

use Illuminate\Http\RedirectResponse;

interface RegisteredContract
{
    public function handle(string $name, string $email, string $password): void;
}
