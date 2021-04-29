<?php

namespace App\Providers;

use App\Models\Checkout;
use App\Models\Vehicle;
use App\Policies\CheckoutPolicy;
use App\Policies\VehiclePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Checkout::class  => CheckoutPolicy::class,
        Vehicle::class  => VehiclePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
