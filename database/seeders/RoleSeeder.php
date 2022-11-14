<?php

namespace Database\Seeders;

use Domain\User\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Guest']);
    }
}
