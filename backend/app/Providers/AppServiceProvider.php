<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentAddressRepository;
use App\Repositories\Eloquent\EloquentCartRepository;
use App\Repositories\Eloquent\EloquentFavoriteRepository;
use App\Repositories\Eloquent\EloquentProductRepository;
use App\Repositories\Eloquent\EloquentReviewRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public array $bindings = [
        CartRepositoryInterface::class => EloquentCartRepository::class,
        ProductRepositoryInterface::class => EloquentProductRepository::class,
        FavoriteRepositoryInterface::class => EloquentFavoriteRepository::class,
        ReviewRepositoryInterface::class => EloquentReviewRepository::class,
        AddressRepositoryInterface::class => EloquentAddressRepository::class,
        UserRepositoryInterface::class => EloquentUserRepository::class,
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
        Paginator::useBootstrap();
    }
}
