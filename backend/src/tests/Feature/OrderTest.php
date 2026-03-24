<?php

use App\Events\OrderPlaced;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Laravel\Sanctum\Sanctum;

it('creates an order and dispatches order placed event', function () {
    Event::fake();

    $user = User::factory()->create();
    $product = Product::factory()->create(['stock' => 20]);
    CartItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 3]);

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/v1/orders');

    $response->assertCreated();
    Event::assertDispatched(OrderPlaced::class);
});
