<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class SelectVehicleController extends Controller
{
    /**
     * @param Vehicle $vehicle
     * @return array|false[]
     */
    public function select_vehicle(Vehicle $vehicle) {
        if($vehicle->status != Vehicle::STATUS_AVAILABLE) {
            return [
                'success' => false
            ];
        }

        return [
            'success' => $vehicle->changeStatus(Vehicle::STATUS_BUSY)
        ];
    }
}
