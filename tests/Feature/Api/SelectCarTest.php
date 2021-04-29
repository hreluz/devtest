<?php

namespace Tests\Feature\Api;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SelectCarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_select_car() {
        $this->createVehicles();

        $this->assertDatabaseCount('vehicles', self::TOTAL_VEHICLES);
        $this->assertDatabaseMissing('vehicles',[
            'status' => Vehicle::STATUS_BUSY
        ]);

        $vehicle = Vehicle::first();

        //Selecting car
        $response = $this->postJson(route('api.v1.select_vehicle', $vehicle->id ));

        $content = $response->decodeResponseJson();
        $response->assertStatus(200);
        $this->assertEquals($content['success'], true);
        $this->assertDatabaseHas('vehicles', [
            'status' => Vehicle::STATUS_BUSY
        ]);
    }

    public function test_select_car_not_available() {
        $this->createVehicles();
        $this->assertDatabaseCount('vehicles', self::TOTAL_VEHICLES);
        $this->assertDatabaseMissing('vehicles',[
            'status' => Vehicle::STATUS_BUSY
        ]);

        $vehicle = Vehicle::first();
        //Selecting car
        $response   = $this->postJson(route('api.v1.select_vehicle', $vehicle->id ));
        $content    = $response->decodeResponseJson();
        $this->assertEquals($content['success'], true);

        //Selecting same car
        $response   = $this->postJson(route('api.v1.select_vehicle', $vehicle->id ));
        $response->assertStatus(403);
    }
}
