@extends('layouts.app')

@section('title', 'Book Ticket')

@section('content')
<h1 class="text-2xl font-bold mb-6">Book Ticket for Flight: {{ $flight->flight_code }}</h1>

<form action="/ticket/submit" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
    @csrf
    <input type="hidden" name="flight_id" value="{{ $flight->id }}">

    <div class="mb-4">
        <label for="passenger_name" class="block text-gray-700 text-sm font-bold mb-2">Passenger Name</label>
        <input type="text" name="passenger_name" id="passenger_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <div class="mb-4">
        <label for="passenger_phone" class="block text-gray-700 text-sm font-bold mb-2">Passenger Phone</label>
        <input type="text" name="passenger_phone" id="passenger_phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <div class="mb-4">
        <label for="seat_number" class="block text-gray-700 text-sm font-bold mb-2">Seat Number</label>
        <input type="text" name="seat_number" id="seat_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>

    <div class="flex items-center justify-between">
        <button  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
            Book Ticket
        </button>
    </div>
</form>
@endsection
