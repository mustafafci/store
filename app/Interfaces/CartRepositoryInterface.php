<?php

namespace App\Interfaces;
use App\Models\Product;

interface CartRepositoryInterface
{
    public function get();

    public function add($product_id , $quantity=1);

    public function update($product_id , $quantity);

    public function total():float;

    public function delete($product_id);
    
    public function empty();
}
