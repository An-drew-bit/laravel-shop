<?php

namespace Database\Seeders;

use App\Models\Product;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::factory(10)
            ->has(Product::factory(rand(5,15)))
            ->create();
    }
}
