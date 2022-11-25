<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Domain\Product\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __invoke(Product $product): Application|Factory|View
    {
        $product->load(['optionValues.option']);

        session()->put('also.' . $product->id, $product->id);

        $also = Product::query()
            ->where(function ($query) use ($product) {
                $query->whereIn('id', session('also'))
                    ->where('id', '!=', $product->id);
        })->get();

        return view('front.product.show', [
            'product' => $product,
            'options' => $product->optionValues->keyValues(),
            'also' => $also
        ]);
    }
}
