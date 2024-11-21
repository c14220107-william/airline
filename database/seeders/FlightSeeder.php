<?php

namespace Database\Seeders;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 0; $i < 12; $i++){
            DB::table('flights')->insert([
            'flight_code' => fake()->languageCode(),
            'origin' => fake()->countryCode(),
            'destination' => fake()->countryCode(),
            'departure_time' => fake()->dateTime(),
            'arrival_time' => fake()->dateTime(),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')




        ]);
        }
        
    }
}
