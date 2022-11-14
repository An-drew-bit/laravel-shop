<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        $categories = Cache::remember('category_home_page', 60*60*24,
            fn() => Category::homePage()->get());

        $brands = Cache::remember('brands_home_page', 60*60*21,
            fn() => Brand::homePage()->get());

        return view('front.home', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => Product::homePage()
                ->get(),
        ]);
    }
}
