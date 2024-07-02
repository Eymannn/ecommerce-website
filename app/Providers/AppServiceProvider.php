<?php

namespace App\Providers;

use App\Enums\UserableType;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
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
    }
}
