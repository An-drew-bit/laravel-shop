<?php

namespace Domain\Cart\StorageIdentities;

use App\Contracts\CartIdentityStorage;

class SessionIdentitiesStorage implements CartIdentityStorage
{
    public function get(): string
    {
        return session()->getId();
    }
}
