<?php

namespace App\Repositories;
use App\Interfaces\CartRepositoryInterface;
use App\Models\Product;

class CartRepository implements CartRepositoryInterface
{
    public function get(){}

    public function add(Product $product , $quantity){}

    public function update(Product $product , $quantity){}

    public function total(): float{

    }

    public function empty(){}
}
