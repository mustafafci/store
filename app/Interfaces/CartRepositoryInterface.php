<?php

namespace App\Interfaces;
use App\Models\Product;

interface CartRepositoryInterface
{
    public function get();

    public function add(Product $product , $quantity=1);

    public function update(Product $product , $quantity);

    public function total():float;
    
    public function empty();
}
