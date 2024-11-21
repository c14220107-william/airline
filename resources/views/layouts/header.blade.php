
<header class="bg-blue-600 text-white py-4">
  <div class="container mx-auto flex justify-between items-center">
      <a href="{{ route('flights.index') }}" class="text-lg font-semibold">Airline Ticket Booking</a>
      <nav>
          <a href="{{ route('flights.index') }}" class="px-4 hover:underline"></a>
          <a href="{{ route('flights.index') }}" class="px-4 hover:underline"></a>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-black-600 hover:text-gray-900">Logout</button>
        </form>
      </nav>
  </div>
</header>