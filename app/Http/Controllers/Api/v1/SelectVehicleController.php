<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Vehicle\SelectRequest;
use App\Models\Vehicle;
use App\Repositories\Vehicle\VehicleRepositoryInterface;

class SelectVehicleController extends Controller
{
    /**
     * @var VehicleRepositoryInterface
     */
    private $repository;

    public function __construct(VehicleRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * @param SelectRequest $request
     * @param Vehicle $vehicle
     * @return array|false[]
     */
    public function select_vehicle(SelectRequest $request, Vehicle $vehicle) {
        return [
            'success' => $this->repository->selectVehicle($vehicle)
        ];
    }
}
