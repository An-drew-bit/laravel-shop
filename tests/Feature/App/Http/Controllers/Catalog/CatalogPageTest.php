<?php

namespace Tests\Feature\App\Http\Controllers\Catalog;

use App\Http\Controllers\Catalog\CatalogController;
use Database\Factories\Domain\Catalog\Models\BrandFactory;
use Database\Factories\Domain\Product\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_success_price_filtered_response(): void
    {
        $product = ProductFactory::new()
            ->count(10)
            ->create(['price' => 200]);

        $expectedProduct = ProductFactory::new()
            ->createOne(['price' => 100000]);

        $request = [
            'filters' => [
                'price' => ['from' => 999, 'to' => 1001]
            ]
        ];

        $this->get(action(CatalogController::class, $request))
            ->assertOk()
            ->assertSee($expectedProduct->title)
            ->assertDontSee($product->random()->first()->title);
    }

    public function test_it_success_brand_filtered_response(): void
    {
        $product = ProductFactory::new()
            ->count(10)
            ->create();

        $brand = BrandFactory::new()->create();

        $expectedProduct = ProductFactory::new()
            ->createOne(['brand_id' => $brand]);

        $request = [
            'filters' => [
                'brands' => [$brand->id => $brand->id]
            ]
        ];

        $this->get(action(CatalogController::class, $request))
            ->assertOk()
            ->assertSee($expectedProduct->title)
            ->assertDontSee($product->random()->first()->title);
    }

    public function test_it_success_sorted_response(): void
    {
        $product = ProductFactory::new()
            ->count(5)
            ->create();

        $request = [
            'sort' => 'title'
        ];

        $this->get(action(CatalogController::class, $request))
            ->assertOk()
            ->assertSee(
                $product->sortBy('title')
                    ->flatMap(fn($item) => [$item->title])
                    ->toArray()
            );
    }
}
