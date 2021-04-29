<?php

namespace App\Repositories\Vehicle;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VehicleRepository implements VehicleRepositoryInterface
{
    protected $model;

    /**
     * VehicleRepository constructor.
     *
     * @param Vehicle $vehicle
     */
    public function __construct(Vehicle $vehicle)
    {
        $this->model = $vehicle;
    }

    public function all($status = [])
    {
        return empty($status) ? $this->model->all() : $this->model->whereIn('status', $status)->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model
                    ->where('id', $id)
                    ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $vehicle = $this->model->find($id)) {
            throw new ModelNotFoundException("Vehicle not found");
        }

        return $vehicle;
    }

    /**
     *
     * Select a Vehicle
     *
     * @param Vehicle $vehicle
     * @return array|false
     */
    public function selectVehicle(Vehicle $vehicle) {

        if($vehicle->status != Vehicle::STATUS_AVAILABLE) {
            return false;
        }

        return $this->changeStatus($vehicle, Vehicle::STATUS_BUSY);
    }

    /**
     * Change status of the vehicle
     *
     * @param Vehicle $vehicle
     * @param $status
     * @return bool|void
     */
    public function changeStatus(Vehicle $vehicle, $status) {
        if(!in_array($status, [Vehicle::STATUS_AVAILABLE, Vehicle::STATUS_BUSY, Vehicle::STATUS_CHECKED_OUT])) {
            return false;
        }

        $vehicle->status = $status;
        return $vehicle->save();
    }
}
