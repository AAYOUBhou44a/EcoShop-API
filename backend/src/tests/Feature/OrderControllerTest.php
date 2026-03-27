<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_list_their_orders()
    {
        $user = User::factory()->create();
        Order::factory()->count(3)->create(['user_id' => $user->id]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/orders');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_user_can_view_single_order()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/orders/' . $order->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $order->id]);
    }

    public function test_user_cannot_view_other_users_order()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $otherUser->id]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/orders/' . $order->id);

        $response->assertStatus(404);
    }

    public function test_user_can_place_order_from_cart()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id, 'price' => 10]);
        CartItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 2]);
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/orders');

        $response->assertStatus(201);
        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'total' => 20]);
        $this->assertDatabaseMissing('cart_items', ['user_id' => $user->id]);
    }

    public function test_user_cannot_place_order_with_empty_cart()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/orders');

        $response->assertStatus(400)
                 ->assertJsonFragment(['message' => 'Cart is empty']);
    }
}