<?php

namespace App\Interfaces;
use App\Models\Product;

interface CartRepositoryInterface
{
    public function get();

    public function add($product_id , $quantity=1);

    public function update(Product $product , $quantity);

    public function total():float;

    public function delete(Product $product);
    
    public function empty();
}
