<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_list_categories()
    {
        $user = User::factory()->create();
        Category::factory()->count(3)->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_user_can_view_single_category()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/categories/' . $category->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $category->id, 'name' => $category->name]);
    }

    public function test_admin_can_create_category()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        Sanctum::actingAs($admin, ['*']);

        $response = $this->postJson('/api/categories', [
            'name' => 'Electronics',
            
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Electronics']);
        $this->assertDatabaseHas('categories', ['name' => 'Electronics']);
    }

    public function test_non_admin_cannot_create_category()
    {
        $user = User::factory()->create(['is_admin' => false]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/categories', [
            'name' => 'Electronics',
        ]);

        $response->assertStatus(403);
    }

    public function test_admin_can_update_category()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::factory()->create();
        Sanctum::actingAs($admin, ['*']);

        $response = $this->putJson('/api/categories/' . $category->id, [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Updated Name']);
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Updated Name']);
    }

    public function test_admin_can_delete_category()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::factory()->create();
        Sanctum::actingAs($admin, ['*']);

        $response = $this->deleteJson('/api/categories/' . $category->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Category deleted']);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_returns_404_for_non_existing_category()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/categories/999');

        $response->assertStatus(404);
    }
}
