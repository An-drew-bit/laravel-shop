<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\OptionFactory;
use Database\Factories\OptionValueFactory;
use Database\Factories\PropertyFactory;
use Domain\Catalog\Models\Category;
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
            ->has(Product::factory(rand(5,15))
                ->hasAttached($optionsValue)
                ->hasAttached($properties, fn() => ['value' => ucfirst(fake()->word())])
            )->create();
    }
}
