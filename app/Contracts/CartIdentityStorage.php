<?php

namespace App\Contracts;

interface CartIdentityStorage
{
    public function get(): string;
}
