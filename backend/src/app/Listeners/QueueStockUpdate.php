<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Jobs\UpdateProductStockJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueueStockUpdate implements ShouldQueue
{
    public function handle(OrderPlaced $event): void
    {
        UpdateProductStockJob::dispatch($event->order);
    }
}
