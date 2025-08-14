<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;

use Illuminate\Support\Facades\Gate;
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
       $this->app->booted(function () {
            if (class_exists(Gate::class)) {
                Gate::policy(Product::class, ProductPolicy::class);
            }
        });
    }
}
