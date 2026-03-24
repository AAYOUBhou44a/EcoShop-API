<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpsertCartItemRequest;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index(): JsonResponse
    {
        $items = auth()->user()->cartItems()->with('product.category')->get();
        $total = $items->sum(fn ($item) => $item->quantity * $item->product->price);

        return response()->json(['items' => $items, 'total' => $total]);
    }

    public function store(UpsertCartItemRequest $request): JsonResponse
    {
        $product = Product::findOrFail($request->integer('product_id'));

        if ($request->integer('quantity') > $product->stock) {
            return response()->json(['message' => 'Requested quantity exceeds stock'], 422);
        }

        $item = CartItem::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['quantity' => $request->integer('quantity')]
        );

        return response()->json(['message' => 'Cart updated', 'item' => $item->load('product')], 201);
    }

    public function update(UpsertCartItemRequest $request, CartItem $cartItem): JsonResponse
    {
        abort_if($cartItem->user_id !== auth()->id(), 403);

        if ($request->integer('quantity') > $cartItem->product->stock) {
            return response()->json(['message' => 'Requested quantity exceeds stock'], 422);
        }

        $cartItem->update($request->validated());

        return response()->json(['message' => 'Cart item updated', 'item' => $cartItem->fresh()->load('product')]);
    }

    public function destroy(CartItem $cartItem): JsonResponse
    {
        abort_if($cartItem->user_id !== auth()->id(), 403);

        $cartItem->delete();

        return response()->json(['message' => 'Cart item removed']);
    }
}
