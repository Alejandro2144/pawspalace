<?php

namespace App\Providers;

use App\Implementations\FinancialFeaturesImplementation;
use App\Interfaces\FinancialFeaturesInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(
            FinancialFeaturesInterface::class,
            FinancialFeaturesImplementation::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
