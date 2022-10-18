<?php

namespace App\Queries\Contract;

use Illuminate\Database\Eloquent\Builder;

interface QueryBuilder
{
    public function getBuilder(): Builder;
}
