<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationEmailJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order)
    {
    }

    public function handle(): void
    {
        Mail::raw(
            "Votre commande #{$this->order->id} a été confirmée.",
            fn ($message) => $message->to($this->order->user->email)->subject('Confirmation de commande EcoShop')
        );
    }
}
