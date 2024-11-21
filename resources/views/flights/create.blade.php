@extends('layouts.app')

@section('title', 'Book Ticket')

@section('content')
<h1 class="text-2xl font-bold mb-6">Create Flight</h1>

<form action="{{ route('flights.store')}}" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
    @csrf
    {{-- <input type="hidden" name="flight_id" value="{{ $flight->id }}"> --}}

    <div class="mb-4">
        <label for="flight_code" class="block text-gray-700 text-sm font-bold mb-2">Flight Code</label>
        <input type="text" name="flight_code" id="flight_code" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <div class="mb-4">
        <label for="origin" class="block text-gray-700 text-sm font-bold mb-2">Origin</label>
        <input type="text" name="origin" id="origin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <div class="mb-4">
        <label for="destination" class="block text-gray-700 text-sm font-bold mb-2">Destination</label>
        <input type="text" name="destination" id="destination" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="mb-4">
        <label for="departure_time" class="block text-gray-700 text-sm font-bold mb-2">Departure Time</label>
        <input type="datetime-local" name="departure_time" id="departure_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div class="mb-4">
        <label for="arrival_time" class="block text-gray-700 text-sm font-bold mb-2">Arrival Time</label>
        <input type="datetime-local" name="arrival_time" id="arrival_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <div class="flex items-center justify-between">
        <button  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
            Book Ticket
        </button>
    </div>
</form>
@endsection