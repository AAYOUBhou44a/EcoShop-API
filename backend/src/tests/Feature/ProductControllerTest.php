<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_user_can_list_products()
    {
        $category = Category::factory()->create();
        Product::factory()->count(5)->create(['category_id' => $category->id]);

        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'links', 'meta']);
    }

    
    public function test_user_can_filter_products_by_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        Product::factory()->count(3)->create(['category_id' => $category1->id]);
        Product::factory()->count(2)->create(['category_id' => $category2->id]);

        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/products?category_id='.$category1->id);

        $response->assertStatus(200);
        $this->assertCount(3, $response->json('data'));
    }

    
    public function test_user_can_view_product_details()
    {
        $product = Product::factory()->create();

        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/products/'.$product->id);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $product->id,
                     'name' => $product->name
                 ]);
    }

   
    public function test_admin_can_create_product()
    {
        $category = Category::factory()->create();

        $admin = User::factory()->create(['is_admin' => true]);
        Sanctum::actingAs($admin, ['*']);

        $response = $this->postJson('/api/products', [
            'name' => 'New Product',
            'description' => 'Description',
            'price' => 10.5,
            'stock' => 5,
            'category_id' => $category->id
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'New Product']);
        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }

    
    public function test_non_admin_cannot_create_product()
    {
        $category = Category::factory()->create();

        $user = User::factory()->create(['is_admin' => false]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/products', [
            'name' => 'Forbidden Product',
            'description' => 'Desc',
            'price' => 10,
            'stock' => 5,
            'category_id' => $category->id
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('products', ['name' => 'Forbidden Product']);
    }

    
    public function test_admin_can_update_product()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $admin = User::factory()->create(['is_admin' => true]);
        Sanctum::actingAs($admin, ['*']);

        $response = $this->putJson('/api/products/'.$product->id, [
            'price' => 20
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'price' => 20]);
    }

    
    public function test_admin_can_delete_product()
    {
        $product = Product::factory()->create();

        $admin = User::factory()->create(['is_admin' => true]);
        Sanctum::actingAs($admin, ['*']);

        $response = $this->deleteJson('/api/products/'.$product->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}

