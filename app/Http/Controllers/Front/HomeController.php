<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        //$products = Product::featured()->active()->latest()->take(8)->get();
        $trending_products = Product::with('category')->active()->latest()->take(8)->get();
    
        return view('welcome' , compact('trending_products'));
    }
}
