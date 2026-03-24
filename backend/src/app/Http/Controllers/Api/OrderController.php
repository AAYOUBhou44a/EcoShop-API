<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderPlaced;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = auth()->user()->is_admin
            ? Order::with('user', 'items.product')->latest()->paginate(20)
            : auth()->user()->orders()->with('items.product')->latest()->paginate(20);

        return response()->json($orders);
    }

    public function store(): JsonResponse
    {
        $user = auth()->user();
        $items = $user->cartItems()->with('product')->get();

        if ($items->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 422);
        }

        $hasInsufficientStock = $items->contains(fn ($i) => $i->quantity > $i->product->stock);
        if ($hasInsufficientStock) {
            return response()->json(['message' => 'Some items are out of stock'], 422);
        }

        $order = DB::transaction(function () use ($user, $items) {
            $total = $items->sum(fn ($i) => $i->quantity * $i->product->price);
            $order = $user->orders()->create(['status' => 'pending', 'total' => $total]);

            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                    'line_total' => $item->quantity * $item->product->price,
                ]);
            }

            $user->cartItems()->delete();

            return $order;
        });

        event(new OrderPlaced($order));

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order->load('items.product'),
        ], 201);
    }
}
