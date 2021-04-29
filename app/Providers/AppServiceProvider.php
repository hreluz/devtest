<?php

namespace App\Providers;

use App\Repositories\Checkout\CheckoutRepository;
use App\Repositories\Checkout\CheckoutRepositoryInterface;
use App\Repositories\Vehicle\VehicleRepository;
use App\Repositories\Vehicle\VehicleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            VehicleRepositoryInterface::class,
            VehicleRepository::class
        );

        $this->app->bind(
            CheckoutRepositoryInterface::class,
            CheckoutRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
