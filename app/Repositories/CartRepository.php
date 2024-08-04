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
    public function get()
    {
        return Cart::with('product')->where('cookie_id', $this->getCookieId())->get();
    }

    public function add($product_id, $quantity = 1)
    {
        $item = Cart::where('cookie_id', $this->getCookieId())
            ->where('product_id', $product_id)->first();

        if (!$item) {
            return Cart::create([
                'cookie_id' => $this->getCookieId(),
                'product_id' => $product_id,
                'user_id' => Auth::id(),
                'quantity' => $quantity
            ]);
        }

        return $item->increment('quantity', $quantity);

    }

    public function update(Product $product, $quantity)
    {
        Cart::where('cookie_id', $this->getCookieId())
            ->where('product_id', $product->id)
            ->update([
                'quantity' => $quantity
            ]);
    }

    public function delete(Product $product)
    {
        Cart::where('cookie_id', $this->getCookieId())
            ->where('product_id', $product->id)
            ->delete();
    }

    public function total(): float
    {
        return Cart::where('cookie_id', $this->getCookieId())
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');
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
