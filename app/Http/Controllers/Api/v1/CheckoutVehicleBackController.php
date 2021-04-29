<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\UpdateCheckoutRequest;
use App\Models\Vehicle;
use App\Repositories\Checkout\CheckoutRepositoryInterface;
use App\Repositories\Vehicle\VehicleRepositoryInterface;
use Illuminate\Http\Request;

class CheckoutVehicleBackController extends Controller
{
    /**
     * @var VehicleRepositoryInterface
     */
    private $vehicleRepository;
    /**
     * @var CheckoutRepositoryInterface
     */
    private $checkoutRepository;

    public function __construct(VehicleRepositoryInterface $vehicleRepository,
                                CheckoutRepositoryInterface $checkoutRepository) {
        $this->vehicleRepository = $vehicleRepository;
        $this->checkoutRepository = $checkoutRepository;
    }

    /**
     * @param UpdateCheckoutRequest $request
     * @param Vehicle $vehicle
     * @return false[]
     */
    public function checkout_vehicle_back(UpdateCheckoutRequest $request, Vehicle $vehicle) {
        $request->merge(['datetime_check_back' => date('Y-m-d H:i:s')]);
        $response = $this->checkoutRepository->update($request->all(), $vehicle->current_checkout->id);

        if($response) {
            $response = $this->vehicleRepository->changeStatus($vehicle,Vehicle::STATUS_AVAILABLE);
        }

        return [
            'success' => $response
        ];
    }
}
