<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Repositories\Vehicle\VehicleRepositoryInterface;
use Illuminate\Http\Request;

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
     * @param Vehicle $vehicle
     * @return array|false[]
     */
    public function select_vehicle(Vehicle $vehicle) {
        return [
            'success' => $this->repository->selectVehicle($vehicle)
        ];
    }
}
