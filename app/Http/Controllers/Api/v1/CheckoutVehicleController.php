<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreCheckoutRequest;
use App\Models\Checkout;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class CheckoutVehicleController extends Controller
{
    /**
     * Checkout Vehicle
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return array
     */
    public function checkout_vehicle(StoreCheckoutRequest $request, Vehicle $vehicle) {
        $checkout = new Checkout();
        $checkout->fill($request->all());
        $checkout->vehicle_id = $vehicle->id;
        $response = $checkout->save();

        if($response) {
            $vehicle->changeStatus(Vehicle::STATUS_CHECKED_OUT);
        }

        return [
            'success' => $response
        ];
    }
}
