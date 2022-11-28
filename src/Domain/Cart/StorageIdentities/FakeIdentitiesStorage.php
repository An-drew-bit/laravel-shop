<?php

namespace Domain\Cart\StorageIdentities;

use App\Contracts\CartIdentityStorage;

class FakeIdentitiesStorage implements CartIdentityStorage
{
    public function get(): string
    {
        return 'tests';
    }
}
