<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Repositories\Vehicle\VehicleRepositoryInterface;

class ListVehiclesController extends Controller
{
    /**
     * @var VehicleRepositoryInterface
     */
    private $repository;

    public function __construct(VehicleRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function list() {
        return [
            'data' =>  VehicleResource::collection($this->repository->all())
        ];
    }
}
