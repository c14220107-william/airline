<?php

namespace Tests\Feature;

use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlightControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test menampilkan daftar penerbangan.
     */
    public function test_can_view_flight_list()
    {
        Flight::factory()->count(5)->create();

        $response = $this->get(route('flights.index'));

        $response->assertStatus(200);
        $response->assertViewHas('flights');
    }

    /**
     * Test menampilkan form pemesanan tiket untuk penerbangan tertentu.
     */
    public function test_can_view_ticket_booking_form()
    {
        $flight = Flight::factory()->create();

        $response = $this->get(route('flights.book', ['flight' => $flight->id]));

        $response->assertStatus(200);
        $response->assertViewHas('flight', $flight);
    }

    /**
     * Test menampilkan form pembuatan penerbangan baru.
     */
    public function test_can_view_create_flight_form()
    {
        $response = $this->get(route('flights.create'));

        $response->assertStatus(200);
        $response->assertViewIs('flights.create');
    }

    /**
     * Test proses penyimpanan penerbangan baru.
     */
    public function test_can_store_new_flight()
    {
        $flightData = [
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now()->addDays(1),
            'arrival_time' => now()->addDays(1)->addHours(2),
        ];

        $response = $this->post(route('flights.create'), $flightData);

        $response->assertStatus(302); // Redirect setelah penyimpanan
        $this->assertDatabaseHas('flights', $flightData);
    }

    public function test_store_flight_fails_due_to_invalid_data()
    {
        // Data yang tidak valid (departure_time di masa lalu)
        $flightData = [
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now()->subDay(), // Waktu yang sudah lewat
            'arrival_time' => now()->addDays(1),
        ];

        // Kirimkan request dengan data yang tidak valid
        $response = $this->post(route('flights.create'), $flightData);

        // Pastikan response status 302 (redirect)
        $response->assertStatus(302);

        // Pastikan ada error pada field departure_time
        $response->assertSessionHasErrors(['departure_time']);
    }



}
