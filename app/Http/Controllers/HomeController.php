<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): Application|Factory|View
    {
        //временно
        $categories = Category::all();
        $brands = Brand::all();

        return view('front.home', [
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}
