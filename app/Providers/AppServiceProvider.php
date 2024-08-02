<?php

namespace App\Providers;

use App\Enums\UserableType;
use App\Listeners\CheckUserStatus;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

     protected $listen = [
        Authenticated::class => [
            CheckUserStatus::class,
        ],
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            UserableType::CUSTOMER => Customer::class,
            UserableType::SELLER   => Seller::class,
        ]);

        \App\Models\Product::observe(\App\Observers\ProductObserver::class);
    }
}
