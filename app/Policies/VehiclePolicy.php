<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;

class VehiclePolicy
{
    public function select(?User $user, Vehicle $vehicle) {
        return $vehicle->status == Vehicle::STATUS_AVAILABLE;
    }
}
