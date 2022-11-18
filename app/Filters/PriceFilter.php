<?php

namespace App\Filters;

use Domain\Catalog\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;

class PriceFilter extends AbstractFilter
{
    public function title(): string
    {
        return 'Цена';
    }

    public function key(): string
    {
        return 'price';
    }

    public function apply(Builder $query): Builder
    {
        return $query->when($this->requestValue(), function (QueryBuilder $query) {
            $query->whereBetween('price', [
                $this->requestValue('from', 0) * 100,
                $this->requestValue('to', 100000) * 100
            ]);
        });
    }

    public function values(): array
    {
        return [
            'from' => 0,
            'to' => 100000,
        ];
    }

    public function view(): string
    {
        return 'front.catalog.filters.price';
    }
}
