<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(ArticleSeeder::class);
        $this->call(BrendSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductBasketSeeder::class);
        $this->call(PromocodeSeeder::class);
        $this->call(ServicePagesSiteSeeder::class);
    }
}
