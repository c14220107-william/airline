@extends('layouts.app')

@section('title', 'Flight Tickets')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tickets for Flight: {{ $flight->flight_code }}</h1>

<table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="py-3 px-4">Passenger Name</th>
            <th class="py-3 px-4">Phone</th>
            <th class="py-3 px-4">Seat Number</th>
            <th class="py-3 px-4">Boarding Status</th>
            <th class="py-3 px-4">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-700">
        @foreach($tickets as $ticket)
        <tr>
            <td class="py-3 px-4">{{ $ticket->passenger_name }}</td>
            <td class="py-3 px-4">{{ $ticket->passenger_phone }}</td>
            <td class="py-3 px-4">{{ $ticket->seat_number }}</td>
            <td class="py-3 px-4">
                @if($ticket->is_boarding)
                Confirmed
                @else
                Not Confirmed
                @endif
            </td>
            <td class="py-3 px-4">
                @if(!$ticket->is_boarding)
                <form action="/ticket/board/{{ $ticket->id }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Boarding</button>
                </form>
                <form action="/ticket/delete/{{ $ticket->id }}" method="POST" class="inline-block ml-2">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                </form>
                @else
                <span class="text-gray-500">Boarded</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
