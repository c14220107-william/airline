<?php

namespace Tests\Unit;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase; 

class FlightTest extends TestCase
{
    use RefreshDatabase;

    public function test_flight_has_many_tickets()
    {
        $flight = Flight::factory()->create();
        $tickets = Ticket::factory()->count(3)->create(['flight_id' => $flight->id]);

        $this->assertCount(3, $flight->tickets);
    }
}
    