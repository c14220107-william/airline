<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index($flightId)
    {
        
        $flight = Flight::findOrFail($flightId);

        $tickets = $flight->tickets;

        return view('tickets.index', compact('flight', 'tickets'));
    }

    
    public function create($flightId)
    {
         
    }

   
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'flight_id'       => 'required|exists:flights,id',
            'passenger_name'  => 'required|string|max:255',
            'passenger_phone' => 'required|string|max:14',
            'seat_number'     => 'required|string|max:3',
        ]);

        
        Ticket::create([
            'flight_id'       => $validated['flight_id'],
            'passenger_name'  => $validated['passenger_name'],
            'passenger_phone' => $validated['passenger_phone'],
            'seat_number'     => $validated['seat_number'],
            'is_boarding'     => 0, 
        ]);

        return redirect()->route('flights.index')->with('success', 'Ticket booked successfully!');
    }

    public function update(Request $request, $ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        $ticket->update([
            'is_boarding'   => 1,  
            'boarding_time' => now(),
        ]);

        return back()->with('success', 'Passenger has boarded successfully.');
    }

    public function destroy($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);

        if ($ticket->is_boarding == 0) {
            $ticket->delete();
            return back()->with('success', 'Ticket deleted successfully.');
        }

        return abort(403, 'Cannot delete a boarded ticket.');
    }

}
