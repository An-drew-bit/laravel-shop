<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ArticleSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductBasketSeeder::class);
        $this->call(PromocodeSeeder::class);
        $this->call(ServicePagesSiteSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
    }
}
