@extends('layouts.app')

@section('title', 'Available Flights')

@section('content')
<h1 class="text-2xl font-bold mb-6">Airplane Booking System</h1>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold text-center mb-8">Airplane Booking System</h1>
    <a href="{{ route('flights.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Tambah secara manual</a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($flights as $flight)
            <div class="bg-gray-200 p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold">{{ $flight->flight_code }}</h2>
                <p>{{ $flight->origin }} → {{ $flight->destination }}</p>

                <div class="mt-4">
                    <p class="text-sm text-gray-500">Departure</p>
                    <p class="font-medium">
                        {{$flight->departure_time }}
                    </p>
                </div>

                <div class="mt-2">
                    <p class="text-sm text-gray-500">Arrived</p>
                    <p class="font-medium">
                        {{ $flight->arrival_time }}
                    </p>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="/flights/book/{{ $flight->id }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Book Ticket</a>
                    <a href="/flights/ticket/{{ $flight->id }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white">
        <tr>
            <th class="py-3 px-4">Flight Code</th>
            <th class="py-3 px-4">Origin</th>
            <th class="py-3 px-4">Destination</th>
            <th class="py-3 px-4">Departure Time</th>
            <th class="py-3 px-4">Arrival Time</th>
            <th class="py-3 px-4">Action</th>
        </tr>
    </thead>
    <tbody class="text-gray-700">
        @foreach($flights as $flight)
        <tr>
            <td class="py-3 px-4">{{ $flight->flight_code }}</td>
            <td class="py-3 px-4">{{ $flight->origin }}</td>
            <td class="py-3 px-4">{{ $flight->destination }}</td>
            <td class="py-3 px-4">{{ $flight->departure_time }}</td>
            <td class="py-3 px-4">{{ $flight->arrival_time }}</td>
            <td class="py-3 px-4">
                <a href="/flights/book/{{ $flight->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Book Ticket</a>
                <a href="/flights/ticket/{{ $flight->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Detail</a>
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($flights as $flight)

        <div class="card bg-white p-4">
            <h2 class="text-xl font-bold mb-2">{{$flight->flight_code}}</h2>
            <p>{{ $flight->origin }} -> {{ $flight->destination }}</p>
            <p>Departure: {{ $flight->departure_time }}</p>
            <p>Arrived: {{ $flight->arrival_time }}</p>
            <a href="/flights/book/{{ $flight->id }}" class="bg-blue-500 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded">Book Ticket</a>
            <a href="/flights/ticket/{{ $flight->id }}" class="bg-blue-500 hover:bg-blue-300 text-white font-bold py-2 px-4 rounded">View Detail</a>



            
            
            
        </div>
            
        @endforeach
    </div>

</div>
 --}}

@endsection
