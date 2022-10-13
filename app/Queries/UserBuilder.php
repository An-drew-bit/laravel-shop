<?php

namespace App\Queries;

use App\Models\User;
use App\Queries\Contract\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return User::query();
    }

    public function getUserByEmail(string $email): Model
    {
        return $this->getBuilder()
            ->where('email', $email)
            ->firstOrFail();
    }
}
