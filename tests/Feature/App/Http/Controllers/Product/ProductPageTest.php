<?php

namespace Tests\Feature\App\Http\Controllers\Product;

use App\Http\Controllers\Product\ProductController;
use Database\Factories\Domain\Product\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_success_response(): void
    {
        $product = ProductFactory::new()
            ->createOne();

        $this->get(action(ProductController::class, $product))
            ->assertOk();
    }


}
