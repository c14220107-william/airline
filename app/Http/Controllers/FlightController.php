<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FlightController extends Controller
{
    public function index()
    {
        
        $flights = Flight::all();
        // $flights->formatted_date = Carbon::parse($flights->departure_time)->format()

        return view('flights.index', compact('flights'));
    }

    public function book($flightId)
    {
        $flight = Flight::findOrFail($flightId);

        return view('tickets.create', compact('flight'));
    }

    public function create(){
        return view("flights.create");
    }

    public function store(Request $request){

        $request->validate([
            'flight_code' => 'required|string|unique:flights,flight_code',
            'origin' => 'required|string|max:3',
            'destination' => 'required|string|max:3',
            'departure_time' => 'required|date|after:now',
            'arrival_time' => 'required|date|after:departure_time',
        ]);
    
        Flight::create($request->all());

        return redirect()->route('flights.index')->with('success', 'Data created successfully');

    }

}
