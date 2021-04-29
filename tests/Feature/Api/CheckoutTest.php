<?php

namespace Tests\Feature\Api;

use App\Models\Checkout;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use DatabaseTransactions;

    public function test_checkout_vehicle() {
        $this->createVehicles();
        $vehicle = Vehicle::first();
        $this->assertDatabaseCount('checkouts', 0);

        $response = $this->postJson(route('api.v1.checkout_vehicle', $vehicle->id), $this->checkoutData());

        $response->assertStatus(200);
        $this->assertDatabaseHas('checkouts', [
            'vehicle_id' => $vehicle->id
        ]);

        $this->assertEquals($vehicle->fresh()->status, Vehicle::STATUS_CHECKED_OUT);
    }

    public function test_validation_on_checkout() {
        $this->createVehicles();
        $vehicle = Vehicle::first();
        $response = $this->postJson(route('api.v1.checkout_vehicle', $vehicle->id));
        $response->assertStatus(422);
        $errors = [
            'customer_name' => "The customer name field is required.",
            'datetime' => "The datetime field is required.",
            'price' => "The price field is required.",
            'seller' => "The seller field is required.",
            'payment_method' => "The payment method field is required."
        ];
        $response->assertJsonValidationErrors($errors);
    }

    public function test_vehicle_is_not_already_checkout() {
        $this->createVehicles();
        $vehicle = Vehicle::first();

        $this->postJson(route('api.v1.checkout_vehicle', $vehicle->id), $this->checkoutData());
        $this->assertEquals($vehicle->refresh()->status, Vehicle::STATUS_CHECKED_OUT);

        $response = $this->postJson(route('api.v1.checkout_vehicle', $vehicle->id), [
            'customer_name' => 'Customer X',
            'datetime'      => date('Y-m-d H:i:s'),
            'price'         => rand(15, 90) * 10000,
            'seller'        => 'Seller Y',
            'payment_method' => Checkout::PAYMENT_CASH
        ]);
        $response->assertStatus(403);
    }

    /**
     *
     * Default Data
     *
     * @return array
     */
    private function checkoutData()
    {
        return [
            'customer_name' => 'Customer X',
            'datetime'      => date('Y-m-d H:i:s'),
            'price'         => rand(15, 90) * 10000,
            'seller'        => 'Seller Y',
            'payment_method' => Checkout::PAYMENT_CASH
        ];
    }
}
