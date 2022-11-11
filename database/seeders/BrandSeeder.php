<?php

namespace Database\Seeders;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(6)->create();
    }
}
