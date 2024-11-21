<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'flight_id' => Flight::factory(),  // Menghasilkan ID penerbangan dari Flight factory
            'passenger_name' => $this->faker->name,  // Nama penumpang
            'passenger_phone' => $this->faker->phoneNumber,  // Nomor telepon penumpang
            'seat_number' => $this->faker->randomElement(['A11', 'B11', 'C11', 'D11', 'E11']),  // Nomor kursi acak
            'is_boarding' => $this->faker->boolean,  // Status boarding, nilai true/false acak
            'boarding_time' => $this->faker->dateTimeBetween('now', '+1 hour'),  // Waktu boarding acak
        ];
    }
}
