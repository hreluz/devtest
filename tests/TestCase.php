<?php

namespace Tests;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    const TOTAL_VEHICLES = 10;

    public function createVehicles() {
        for ($i = 1 ; $i <= self::TOTAL_VEHICLES ; $i++) {
            $vehicle = new Vehicle();
            $vehicle->brand    = "Brand ${i}";
            $vehicle->name     = "Name ${i}";
            $vehicle->save();
        }
    }
}
