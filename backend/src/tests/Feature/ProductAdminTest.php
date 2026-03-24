<?php

use App\Models\Category;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('allows admin to create a product', function () {
    Sanctum::actingAs(User::factory()->admin()->create());
    $category = Category::factory()->create();

    $response = $this->postJson('/api/v1/admin/products', [
        'category_id' => $category->id,
        'name' => 'Eco Bottle',
        'slug' => 'eco-bottle',
        'price' => 19.90,
        'stock' => 50,
    ]);

    $response->assertCreated();
});
