<?php

namespace Domain\User\Actions\Contract;

use Domain\User\DTO\NewUserDTO;

interface RegisteredContract
{
    public function __invoke(NewUserDTO $data): void;
}
