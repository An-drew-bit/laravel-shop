<?php

namespace Domain\Catalog\ViewModels;

use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Support\Traits\Makeable;

final class CategoryViewModel
{
    use Makeable;

    public function homePage(): Collection|array
    {
        return Cache::remember('category_home_page', 60*60*24,
            fn() => Category::homePage()->get());
    }
}
