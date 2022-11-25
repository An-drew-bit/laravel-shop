<?php

namespace Tests\Feature\App\Jobs;

use App\Jobs\ProductJsonPropertiesJob;
use Database\Factories\Domain\Product\ProductFactory;
use Database\Factories\Domain\Product\PropertyFactory;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProductJsonPropertiesTest extends TestCase
{
    public function test_created_json_properties(): void
    {
        $queue = Queue::getFacadeRoot();

        Queue::fake([ProductJsonPropertiesJob::class]);

        $properties = PropertyFactory::new()
            ->count(10)
            ->create();

        $product = ProductFactory::new()
            ->hasAttached($properties, fn() => ['value' => fake()->word()])
            ->create();

        $this->assertEmpty($product->json_properties);

        Queue::swap($queue);

        ProductJsonPropertiesJob::dispatchSync($product);

        $product->refresh();

        $this->assertNotEmpty($product->json_properties);
    }
}
