<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductController;


Route::group(['as' => 'front.'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('cart/delete', [CartController::class, 'delete'])->name('cart.delete');

    Route::get('checkout', [OrderController::class, 'create'])->name('checkout');
    Route::post('checkout', [OrderController::class, 'store'])->name('checkout.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

require __DIR__ . '/dashboard.php';
