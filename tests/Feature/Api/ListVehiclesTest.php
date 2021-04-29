<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListVehiclesTest extends TestCase
{
    use DatabaseTransactions;

    public function test_lists_cars_in_api() {
        $this->createVehicles();

        $response = $this->getJson(route('api.v1.list_vehicles'));
        $content = $response->decodeResponseJson();

        $response->assertStatus(200);
        $this->assertEquals(count($content['data']), self::TOTAL_VEHICLES);
    }
}
