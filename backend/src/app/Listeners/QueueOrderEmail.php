<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Jobs\SendOrderConfirmationEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueueOrderEmail implements ShouldQueue
{
    public function handle(OrderPlaced $event): void
    {
        SendOrderConfirmationEmailJob::dispatch($event->order);
    }
}
