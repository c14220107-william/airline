<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        
        // Daftar kode negara yang umum
        $countryCodes = ['US', 'FR', 'ID', 'CN', 'JP', 'IN', 'BR', 'ZA', 'NG', 'RU'];

        return [
            'flight_code' => 'FL' . $this->faker->randomNumber(3, true), // Kode penerbangan acak
            'origin' => $countryCodes[array_rand($countryCodes)],         // Pilih asal dari array kode negara
            'destination' => $countryCodes[array_rand($countryCodes)], // Pilih tujuan dari array kode negara
            'departure_time' => now(),  // Temporarily use a static date
            'arrival_time' => now()->addHours(2),
        ];   
    }
}
