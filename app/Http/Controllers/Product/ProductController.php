<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\View\ViewModels\ProductViewModel;
use Domain\Product\Models\Product;

class ProductController extends Controller
{
    public function __invoke(Product $product): ProductViewModel
    {
        return (new ProductViewModel($product))
            ->view('front.product.show');
    }
}
