<?php

namespace Tests\Feature\Api;

use App\Models\Checkout;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CheckBackTest extends TestCase
{
    use DatabaseTransactions;

    public function test_check_vehicle_back() {
        $this->checkout_first_car();
        $vehicle = Vehicle::first();

        $this->assertEquals($vehicle->status, Vehicle::STATUS_CHECKED_OUT);
        $this->assertDatabaseCount('checkouts', 1);
        $this->assertNull(Checkout::first()->datetime_check_back);

        $response = $this->putJson(route('api.v1.checkout_vehicle_back', $vehicle->id));
        $response->assertStatus(200);
        $this->assertNotNull(Checkout::first()->datetime_check_back);
        $this->assertEquals($vehicle->refresh()->status, Vehicle::STATUS_AVAILABLE);
    }

    public function test_check_vehicle_can_be_back() {
        $this->createVehicles();
        $vehicle = Vehicle::first();
        $response = $this->putJson(route('api.v1.checkout_vehicle_back', $vehicle->id));
        $response->assertStatus(403);
    }

    private function checkout_first_car()
    {
        $this->createVehicles();
        $vehicle = Vehicle::first();
        $this->assertDatabaseCount('checkouts', 0);

        $response = $this->postJson(route('api.v1.checkout_vehicle', $vehicle->id), [
            'customer_name' => 'Customer X',
            'datetime'      => date('Y-m-d H:i:s'),
            'price'         => rand(15, 90) * 10000,
            'seller'        => 'Seller Y',
            'payment_method' => Checkout::PAYMENT_CASH
        ]);

        $response->assertStatus(200);
    }
}
