<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }
    public function get()
    {
        if (!$this->items->count()) {
            $this->items = Cart::with('product')->where('cookie_id', $this->getCookieId())->get();
        }
        return $this->items;
    }

    public function add($product_id, $quantity = 1)
    {
        $item = Cart::where('cookie_id', $this->getCookieId())
            ->where('product_id', $product_id)->first();

        if (!$item) {
            $item = Cart::create([
                'cookie_id' => $this->getCookieId(),
                'product_id' => $product_id,
                'user_id' => Auth::id(),
                'quantity' => $quantity
            ]);

            $this->get()->push($item);
            return $item;
        }

        return $item->increment('quantity', $quantity);

    }

    public function update($product_id, $quantity)
    {
        Cart::where('cookie_id', $this->getCookieId())
            ->where('product_id', $product_id)
            ->update([
                'quantity' => $quantity
            ]);
    }

    public function delete($product_id)
    {
        Cart::where('cookie_id', $this->getCookieId())
            ->where('product_id', $product_id)
            ->delete();

    }

    public function total(): float
    {
        // return (float) Cart::where('cookie_id', $this->getCookieId())
        //     ->join('products', 'products.id', '=', 'carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.quantity) as total')
        //     ->value('total');

        return $this->get()->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }

    public function empty()
    {
        Cart::where('cookie_id', $this->getCookieId())->delete();
    }

    public function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');

        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }

        return $cookie_id;
    }
}
