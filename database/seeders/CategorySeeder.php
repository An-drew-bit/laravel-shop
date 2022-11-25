<?php

namespace Database\Seeders;

use Database\Factories\Domain\Product\OptionFactory;
use Database\Factories\Domain\Product\OptionValueFactory;
use Database\Factories\Domain\Product\ProductFactory;
use Database\Factories\Domain\Product\PropertyFactory;
use Domain\Catalog\Models\Category;
use Domain\Product\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $properties = PropertyFactory::new()
            ->count(10)
            ->create();

        OptionFactory::new()->count(2)->create();

        $optionsValue = OptionValueFactory::new()
            ->count(10)
            ->create();

        Category::factory(10)
            ->has(ProductFactory::new()
                ->count(rand(5,15))
                ->hasAttached($optionsValue)
                ->hasAttached($properties, fn() => ['value' => ucfirst(fake()->word())])
            )->create();
    }
}
