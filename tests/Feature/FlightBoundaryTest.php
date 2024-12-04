<?php

namespace Tests\Feature;

use App\Models\Flight;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class FlightBoundaryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(); // Buat pengguna
        $this->actingAs($user); // Autentikasi pengguna;
    }

    /**
     * Test boundary untuk departure_time.
     */

    public function test_flight_departure_time_boundary()
    {
        $validData = [
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now()->addDay()->toDateTimeString(),
            'arrival_time' => now()->addDay()->addHours(2)->toDateTimeString(),
        ];

        // 1. Valid case: Departure time in the future
        $response = $this->post(route('flights.store'), array_merge($validData, [
            'departure_time' => Carbon::now()->addDay(), // Masa depan
        ]));
        $response->assertStatus(302); // Redirect setelah sukses
        $this->assertDatabaseHas('flights', [
            'departure_time' => Carbon::now()->addDay()->toDateTimeString(),
        ]);

        // 2. Invalid case: Departure time exactly now
        $response = $this->post(route('flights.store'), array_merge($validData, [
            'departure_time' => Carbon::now(), // Tepat saat ini
        ]));
        $response->assertSessionHasErrors(['departure_time']); // Gagal validasi

        // 3. Invalid case: Departure time in the past
        $response = $this->post(route('flights.store'), array_merge($validData, [
            'departure_time' => Carbon::now()->subDay(), // Masa lalu
        ]));
        $response->assertSessionHasErrors(['departure_time']); // Gagal validasi
    }
    
    public function test_flight_code_boundary()
    {
        $validData = [
            'flight_code' => 'JT610',
            'origin' => 'SUB',
            'destination' => 'CGK',
            'departure_time' => now()->addDay()->toDateTimeString(),
            'arrival_time' => now()->addDay()->addHours(2)->toDateTimeString(),
        ];

        // 1. Valid case: Exactly 5 characters (integration test)
        $response = $this->post(route('flights.store'), array_merge($validData, [
            'flight_code' => 'JT610', // Tepat 5 karakter
        ]));
        $response->assertStatus(302); // Redirect sukses
        $this->assertDatabaseHas('flights', ['flight_code' => 'JT610']);

        
        // 2. Invalid case: Less than 5 characters (unit test)
        $response = $this->post(route('flights.store'), array_merge($validData, [
            'flight_code' => 'JT1', // Kurang dari 5 karakter
        ]));
        $response->assertSessionHasErrors(['flight_code']); // Gagal validasi

        // 3. Invalid case: More than 5 characters (unit test)
        $response = $this->post(route('flights.store'), array_merge($validData, [
            'flight_code' => 'JT1234567890', // Lebih dari 10 karakter
        ]));
        $response->assertSessionHasErrors(['flight_code']); // Gagal validasi
    }

}
