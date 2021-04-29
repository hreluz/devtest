<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class ListVehiclesController extends Controller
{
    /**
     * @return array
     */
    public function list() {
        return [
            'data' => Vehicle::get()->toArray()
        ];
    }
}
