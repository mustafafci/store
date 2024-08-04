<?php

namespace App\View\Components;

use App\Facades\Cart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
{
    public $total, $cart;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        
        $this->total = Cart::total();
        $this->cart = Cart::get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }
}
