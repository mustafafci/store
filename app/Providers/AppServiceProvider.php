<?php

namespace App\Providers;

use App\Listeners\EmptyCart;
use App\Listeners\ReduceProductQuantity;
use App\Repositories\CartRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CartRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Event::listen(ReduceProductQuantity::class);
        // Event::listen(
        //     EmptyCart::class
        // );
    }
}
