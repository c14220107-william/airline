@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-50">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center mb-6 text-blue-800">Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Name</label>
                <input type="text" id="name" name="name" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-semibold">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 mt-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                Register
            </button>
        </form>
        <p class="text-center text-gray-600 mt-4">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                Login here
            </a>
        </p>
    </div>
</div>
@endsection
