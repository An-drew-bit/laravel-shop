<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        return view('front.home', [
            'categories' => Category::homePage()
                ->get(),
            'brands' => Brand::homePage()
                ->get(),
            'products' => Product::homePage()
                ->get(),
        ]);
    }
}
