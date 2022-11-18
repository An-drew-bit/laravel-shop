<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Domain\Catalog\ViewModels\BrandViewModel;
use Domain\Catalog\ViewModels\CategoryViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        return view('front.home', [
            'categories' => CategoryViewModel::make()
                ->homePage(),
            'brands' => BrandViewModel::make()
                ->homePage(),
            'products' => Product::homePage()
                ->get(),
        ]);
    }
}
