<?php

namespace Tests\Feature;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test menampilkan daftar tiket dari penerbangan tertentu.
     */
    public function test_can_view_ticket_list_for_flight()
    {
        $this->withoutMiddleware(); // Melewati semua middleware

        $flight = Flight::factory()->create();
        Ticket::factory()->count(3)->create(['flight_id' => $flight->id]);

        $response = $this->get(route('tickets.index', ['flight' => $flight->id]));

        $response->assertStatus(200);
        $response->assertViewHas('tickets');
    }

    /**
     * Test memproses pemesanan tiket baru.
     */
    public function test_can_book_ticket_for_flight()
    {
        $flight = Flight::factory()->create();
        $ticketData = [
            'flight_id' => $flight->id,
            'passenger_name' => 'John Doe',
            'passenger_phone' => '081234567890',
            'seat_number' => 'A01',
        ];

        $response = $this->post(route('ticket.submit'), $ticketData);

        $response->assertStatus(302); // Redirect setelah berhasil
        $this->assertDatabaseHas('tickets', $ticketData);
    }

    /**
     * Test mengonfirmasi boarding penumpang.
     */
    public function test_can_confirm_boarding_for_ticket()
    {
        $ticket = Ticket::factory()->create(['is_boarding' => 0]);

        $response = $this->put(route('ticket.board', ['ticket' => $ticket->id]));

        $response->assertStatus(302); // Redirect setelah berhasil
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'is_boarding' => 1,
            'boarding_time' => now()->toDateTimeString(),
        ]);
    }

    /**
     * Test menghapus tiket jika belum boarding.
     */
    public function test_can_delete_ticket_if_not_boarded()
    {
        $ticket = Ticket::factory()->create(['is_boarding' => 0]);

        $response = $this->delete(route('ticket.delete', ['ticket' => $ticket->id]));

        $response->assertStatus(302); // Redirect setelah berhasil
        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
    }

    /**
     * Test tidak bisa menghapus tiket jika sudah boarding.
     */
    public function test_cannot_delete_ticket_if_boarded()
    {
        $ticket = Ticket::factory()->create(['is_boarding' => 1]);

        $response = $this->delete(route('ticket.delete', ['ticket' => $ticket->id]));

        // Memastikan status 403 jika tiket sudah boarding
        $response->assertStatus(403);
        $this->assertDatabaseHas('tickets', ['id' => $ticket->id]);
    }
}
