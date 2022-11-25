<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\HomeController;
use Database\Factories\Domain\Catalog\Models\BrandFactory;
use Database\Factories\Domain\Catalog\Models\CategoryFactory;
use Database\Factories\Domain\Product\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_success_response(): void
    {
        CategoryFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        $category = CategoryFactory::new()->createOne([
            'on_home_page' => true,
            'sorting' => 1
        ]);

        ProductFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        $product = ProductFactory::new()->createOne([
            'on_home_page' => true,
            'sorting' => 1
        ]);

        BrandFactory::new()->count(5)
            ->create([
                'on_home_page' => true,
                'sorting' => 999
            ]);

        $brand = BrandFactory::new()->createOne([
            'on_home_page' => true,
            'sorting' => 1
        ]);

        $this->get(action(HomeController::class))
            ->assertOk()
            ->assertViewHas('categories.0', $category)
            ->assertViewHas('products.0', $product)
            ->assertViewHas('brands.0', $brand);
    }
}
