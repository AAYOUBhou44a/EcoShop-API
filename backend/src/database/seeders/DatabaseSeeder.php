<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
=======
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> dev
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
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
=======
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> dev
    }
}
