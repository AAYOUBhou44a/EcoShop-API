<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'EcoShop Admin',
            'email' => 'admin@ecoshop.test',
        ]);

        User::factory()->create([
            'name' => 'EcoShop User',
            'email' => 'user@ecoshop.test',
        ]);

        Category::factory(6)
            ->has(Product::factory()->count(8))
            ->create();
    }
}
