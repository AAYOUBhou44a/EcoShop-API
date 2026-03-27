<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_list_cart_items()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        CartItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 2]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/cart');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }

    public function test_user_can_add_product_to_cart()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['message' => 'Product added to cart']);
        $this->assertDatabaseHas('cart_items', ['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 3]);
    }

    public function test_adding_existing_product_increases_quantity()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        CartItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 2]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 3,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('cart_items', ['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 5]);
    }

    public function test_user_can_update_cart_item_quantity()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $cartItem = CartItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 2]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson('/api/cart/' . $cartItem->id, ['quantity' => 5]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Cart updated']);
        $this->assertDatabaseHas('cart_items', ['id' => $cartItem->id, 'quantity' => 5]);
    }

    public function test_user_can_remove_item_from_cart()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $cartItem = CartItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 2]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->deleteJson('/api/cart/' . $cartItem->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Product removed from cart']);
        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
    }

    public function test_user_cannot_update_other_users_cart_item()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $cartItem = CartItem::create(['user_id' => $otherUser->id, 'product_id' => $product->id, 'quantity' => 2]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->putJson('/api/cart/' . $cartItem->id, ['quantity' => 5]);

        $response->assertStatus(404);
    }
}
