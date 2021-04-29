<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;

class CheckoutPolicy
{
    public function create(?User $user, Vehicle $vehicle) {
        return $vehicle->status != Vehicle::STATUS_CHECKED_OUT;
    }

    public function update(?User $user, Vehicle $vehicle) {
        return $vehicle->status === Vehicle::STATUS_CHECKED_OUT &&  $vehicle->current_checkout;
    }
}
