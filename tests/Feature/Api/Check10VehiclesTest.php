<?php

namespace Tests\Feature\Api;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class Check10VehiclesTest extends TestCase
{
    use DatabaseTransactions;

    public function test_generate_10_dummy_vehicles() {
        $this->createVehicles();
        $this->assertEquals(Vehicle::get()->count(), self::TOTAL_VEHICLES);
    }
}
