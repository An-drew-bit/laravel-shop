<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __invoke(Product $product): Application|Factory|View
    {
        $product->load(['optionValues.option']);

        $options = $product->optionValues->mapToGroups(
            fn($item) => [$item->option->title => $item]
        );

        return view('front.product.show', [
            'product' => $product,
            'options' => $options
        ]);
    }
}
