<?php

namespace Tests\Unit;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase; 

class TicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_belongs_to_flight()
    {
        $flight = Flight::factory()->create();
        $ticket = Ticket::factory()->create(['flight_id' => $flight->id]);

        $this->assertEquals($flight->id, $ticket->flight->id);
    }
}
