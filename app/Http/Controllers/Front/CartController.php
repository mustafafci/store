<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\CartRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartRepositoryInterface $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {

        return view('front.cart', [
            'cart' => $this->cart
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'min:1']
        ]);

        $this->cart->add($request->product_id, $request->quantity);

        return redirect()->route('front.cart.index');
    }


    public function update(Request $request)
    {

        $this->cart->update($request->product_id, $request->quantity);
    }

    public function delete(Request $request)
    {
        $this->cart->delete($request->product_id);
        return response()->json(['success' => 'deleted successfully']);
    }
}
