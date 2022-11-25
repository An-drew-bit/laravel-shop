<?php

namespace App\View\ViewModels;

use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Support\Facades\Cache;
use Spatie\ViewModels\ViewModel;

class HomeViewModel extends ViewModel
{
    public function __construct()
    {
    }

    public function categories(): mixed
    {
        return Cache::remember('category_home_page', 60*60*24,
            fn() => Category::homePage()->get());
    }

    public function brands(): mixed
    {
        return Cache::remember('brands_home_page', 60*60*21,
            fn() => Brand::homePage()->get());
    }

    public function products(): mixed
    {
        return Product::homePage()
            ->get();
    }
}
