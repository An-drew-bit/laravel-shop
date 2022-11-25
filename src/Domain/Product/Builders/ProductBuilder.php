<?php

namespace Domain\Product\Builders;

use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;
use Support\Facades\Sorter;

final class ProductBuilder extends Builder
{
   public function homePage(): Builder
   {
       return $this->where('on_home_page', true)
           ->orderBy('sorting')
           ->limit(8);
   }

    public function filtered(): self
    {
        return app(Pipeline::class)
            ->send($this)
            ->through(filters())
            ->thenReturn();
    }

    public function sorted(): Builder|self
    {
        return Sorter::run($this);
    }

    public function search(): self
    {
        return $this->when(request('search'), function (Builder $query) {
            $query->whereFullText(['title', 'text'], request('search'));
        });
    }

    public function withCategory(Category $category): self
    {
        return $this->when($category->exists, function (Builder $query) use ($category) {
            $query->whereRelation('categories', 'categories.id', '=', $category->id);
        });
    }
}
