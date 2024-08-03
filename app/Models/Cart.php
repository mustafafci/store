<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options'
    ];

    // Events (Observers)
    // creating , created , updating , updated , deleteing , deleted
    // restoring , restored , retrieved , saving , saved

    public function booted()
    {
        // trigger every time creating cart
        // static::creating(function (Cart $cart) {
        //     $cart->id = Str::uuid();
        // });
        static::observe(CartObserver::class);
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
