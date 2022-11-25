<?php

declare(strict_types=1);

namespace Domain\Catalog\Sorters;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Stringable;

final class Sorter
{
    public const SORT_KEY = 'sort';

    public function __construct(protected array $columns = [])
    {
    }

    public function run(Builder $query): Builder
    {
        $sortData = $this->sortData();

        return $query->when($sortData->contains($this->getColumns()), function (Builder $builder) use ($sortData) {
            $builder->orderBy((string) $sortData->remove('-'),
            $sortData->contains('-') ? 'DESC' : 'ASC');
        });
    }

    public function getKey(): string
    {
        return self::SORT_KEY;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function sortData(): Stringable
    {
        return request()->str($this->getKey());
    }

    public function isActive(string $column, string $direction = 'ASC'): bool
    {
        $column = trim($column, '-');

        if (strtolower($direction) === 'DESC') {
            $column = '-' . $column;
        }

        return request($this->getKey()) === $column;
    }
}
