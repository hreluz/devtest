<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\StoreCheckoutRequest;
use App\Models\Vehicle;
use App\Repositories\Checkout\CheckoutRepositoryInterface;
use App\Repositories\Vehicle\VehicleRepositoryInterface;

class CheckoutVehicleController extends Controller
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
     * Checkout Vehicle
     *
     * @param StoreCheckoutRequest $request
     * @param Vehicle $vehicle
     * @return array
     */
    public function checkout_vehicle(StoreCheckoutRequest $request, Vehicle $vehicle) {
        $request->merge(['vehicle_id' => $vehicle->id]);
        $response = $this->checkoutRepository->create($request->all());

        if($response) {
            $response = $this->vehicleRepository->changeStatus($vehicle,Vehicle::STATUS_CHECKED_OUT);
        }

        return [
            'success' => $response
        ];
    }
}
