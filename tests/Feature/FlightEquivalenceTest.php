<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlightEquivalenceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(); // Buat pengguna
        $this->actingAs($user); // Autentikasi pengguna;
    }

    /** integration
     * Test input valid (Equivalence Class: Valid).
     */
    public function test_valid_input_creates_flight()
    {
        $validData = [
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now()->addDay()->toDateTimeString(),
            'arrival_time' => now()->addDay()->addHours(2)->toDateTimeString(),
        ];

        $response = $this->post(route('flights.store'), $validData);

        $response->assertStatus(302); // Redirect setelah berhasil
        $this->assertDatabaseHas('flights', $validData);
    }

    /** unit test
     * Test input invalid: flight_code kosong (Equivalence Class: Invalid).
     */
    public function test_invalid_input_flight_code_empty()
    {
        $invalidData = [
            'flight_code' => '',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now()->addDay()->toDateTimeString(),
            'arrival_time' => now()->addDay()->addHours(2)->toDateTimeString(),
        ];

        $response = $this->post(route('flights.store'), $invalidData);

        $response->assertStatus(302); // Redirect karena error
        $response->assertSessionHasErrors(['flight_code']);
    }

    /** unit test
     * Test input invalid: origin tidak 3 huruf (Equivalence Class: Invalid).
     */
    public function test_invalid_input_origin_not_three_letters()
    {
        $invalidData = [
            'flight_code' => 'JT610',
            'origin' => 'SURR',
            'destination' => 'CGK',
            'departure_time' => now()->addDay()->toDateTimeString(),
            'arrival_time' => now()->addDay()->addHours(2)->toDateTimeString(),
        ];

        $response = $this->post(route('flights.store'), $invalidData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['origin']);
    }

    /** unit test
     * Test input invalid: departure_time di masa lalu (Equivalence Class: Invalid).
     */
    public function test_invalid_input_departure_time_in_past()
    {
        $invalidData = [
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now()->subDay()->toDateTimeString(),
            'arrival_time' => now()->addDay()->toDateTimeString(),
        ];

        $response = $this->post(route('flights.store'), $invalidData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['departure_time']);
    }

    /** unit test
     * Test input invalid: arrival_time sebelum departure_time (Equivalence Class: Invalid).
     */
    public function test_invalid_input_arrival_time_before_departure_time()
    {
        $invalidData = [
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now()->addDay()->toDateTimeString(),
            'arrival_time' => now()->toDateTimeString(),
        ];

        $response = $this->post(route('flights.store'), $invalidData);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['arrival_time']);
    }
}

