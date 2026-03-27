<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use App\Events\OrderPlaced;
//OrderController : passer commande + event OrderPlaced
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

  

    // 🔹 User: list their orders
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->get();
        return response()->json($orders);
    }

    // 🔹 User: show one order
    public function show($id, Request $request)
    {
        $order = Order::where('user_id', $request->user()->id)
                      ->findOrFail($id);

        return response()->json($order);
    }

    // 🔹 User: place order
    public function store(Request $request)
    {
        $user = $request->user();

        // get cart items
        $cartItems = CartItem::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message'=>'Cart is empty'], 400);
        }

        DB::beginTransaction();

        try {
            // calculate total
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->quantity * $item->product->price;
            }

            // create order
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total
            ]);

            // attach products (pivot)
             foreach($cartItems as $item){
                $order->orderItems()->create([
                    'product_id'=>$item->product_id,
                    'quantity'=> $item->quantity,
                    'price'=> $item->product->price
                ]);
             }

            // clear cart
            CartItem::where('user_id', $user->id)->delete();

            DB::commit();

           
            event(new OrderPlaced($order));

            return response()->json($order, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>'Order failed'], 500);
        }
    }







}




