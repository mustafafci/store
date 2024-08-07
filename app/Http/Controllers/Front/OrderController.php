<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Events\ReduceProductQuantityEvent;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\CartRepositoryInterface;

class OrderController extends Controller
{
    public function create(CartRepositoryInterface $cart)
    {
        if ($cart->get()->count() == 0) {
            return redirect()->route('front.home');
        }
        return view('front.checkout', ['cart' => $cart]);
    }

    public function store(Request $request, CartRepositoryInterface $cartRepositoryInterface)
    {
        DB::beginTransaction();
        try {
            $cart = $cartRepositoryInterface->get()->groupBy('product.store_id')->all();
            //  dd($cart);

            foreach ($cart as $store_id => $order_products) {
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'store_id' => $store_id,
                    'payment_method' => 'COD'
                ]);


                foreach ($order_products as $item) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'product_price' => $item->product->price,
                        'quantity' => $item->quantity
                    ]);
                }


                foreach ($request->post('address') as $key => $address) {
                    $address['type'] = $key;
                    $order->addresses()->create($address);
                }
                event(new ReduceProductQuantityEvent($order));
                event(new OrderCreated($order));
                // event('order.created');
                // OrderCreated::dispatch($order);
            }
            //  $cartRepositoryInterface->empty();

            DB::commit();
            //event('order.created');
            flash()->success('created successfully');
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            // return redirect()->back()->withErrors($e->getMessage());
            throw $e;
        }
    }
}
