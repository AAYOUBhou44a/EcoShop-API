<?php

namespace App\Providers;

use App\Events\OrderPlaced;
use App\Listeners\QueueOrderEmail;
use App\Listeners\QueueStockUpdate;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderPlaced::class => [
            QueueOrderEmail::class,
            QueueStockUpdate::class,
        ],
    ];
}
