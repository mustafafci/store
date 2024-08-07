<?php

namespace App\Listeners;

use App\Facades\Cart;
use App\Models\Product;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ReduceProductQuantityEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReduceProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReduceProductQuantityEvent $event): void
    {
        //dd($event->order->products);
        foreach ($event->order->products as $product) {
            $product->decrement('quantity', $product->pivot->quantity);

        }
        // foreach (Cart::get() as $item) {
        //     Product::where('id', $item->product_id)
        //         ->update([
        //             'quantity' => DB::raw("quantity - {$item->quantity}")
        //         ]);
        // }


    }
}
