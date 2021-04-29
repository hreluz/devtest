<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\UpdateCheckoutRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CheckoutVehicleBackController extends Controller
{
    /**
     * @param UpdateCheckoutRequest $request
     * @param Vehicle $vehicle
     * @return false[]
     */
    public function checkout_vehicle_back(UpdateCheckoutRequest $request, Vehicle $vehicle) {
        $checkout = $vehicle->current_checkout;
        $checkout->datetime_check_back = date('Y-m-d H:i:s');
        $response = $checkout->save();

        if($response) {
            $vehicle->changeStatus(Vehicle::STATUS_AVAILABLE);
        }

        return [
            'success' => $response
        ];
    }
}
