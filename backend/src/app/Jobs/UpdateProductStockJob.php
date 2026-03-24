<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class UpdateProductStockJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function handle(): void
    {
        DB::transaction(function () {
            $this->order->loadMissing('items.product');

            foreach ($this->order->items as $item) {
                $item->product->decrement('stock', $item->quantity);
            }

            $this->order->update(['status' => 'confirmed']);
        });
    }
}
