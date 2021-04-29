<?php

namespace App\Repositories\Checkout;

use App\Models\Checkout;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    protected $model;

    /**
     * VehicleRepository constructor.
     *
     * @param Checkout $checkout
     */
    public function __construct(Checkout $checkout)
    {
        $this->model = $checkout;
    }

    public function all()
    {
        return $this->model->all();
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
            throw new ModelNotFoundException("Checkout not found");
        }

        return $vehicle;
    }

}
