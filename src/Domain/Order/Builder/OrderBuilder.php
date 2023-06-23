<?php

declare(strict_types=1);

namespace Domain\Order\Builder;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class OrderBuilder extends Builder
{
    public function getUserOrder(int $id): Collection
    {
        return $this
            ->where('user_id', $id)
            ->get();
    }
}
