<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentCartRepository;
use App\Repositories\Eloquent\EloquentProductRepository;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public array $bindings = [
        CartRepositoryInterface::class => EloquentCartRepository::class,
        ProductRepositoryInterface::class => EloquentProductRepository::class,
    ];
    public function register(): void
    {
        // $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        // $this->app->bind(CartRepositoryInterface::class, EloquentCartRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
