<?php

namespace Domain\User\Builders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class UserBuilder extends Builder
{
    public function getByEmail(string $email): ?Model
    {
        return $this->where('email', $email)
            ->firstOrFail();
    }

    public function getById(int $id): ?Model
    {
        return $this->findOrFail($id);
    }
}
