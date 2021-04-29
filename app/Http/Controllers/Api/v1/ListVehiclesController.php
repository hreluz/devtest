<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ListVehiclesController extends Controller
{
    public function list() {
        return [
            'data' => Vehicle::get()->toArray()
        ];
    }
}
