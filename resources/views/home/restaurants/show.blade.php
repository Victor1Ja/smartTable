<x-site-layout title="USER ZONE - RESTAURANTS">

    <!-- Back to Index Link -->
    <a class="underline" href="{{ route('restaurants.index') }}">Back to the index</a>

    <!-- Restaurant Details Section -->
    <div class="mt-4">

        <!-- Logo -->
        <img src="{{ $restaurant->imageUrl ?? 'https://via.placeholder.com/640x480.png/00ff77?text=No+Image'}}" alt="{{ $restaurant->name }} Logo" class="w-24 h-24 object-contain mb-4">

        <!-- Name -->
        <h1 class="text-2xl font-bold">{{ $restaurant->name }}</h1>

        <!-- Location -->
        <p class="text-gray-600 mt-2">
            <span class="font-bold">Location:</span> {{ $restaurant->location }}
        </p>

        <!-- Contact Information -->
        <p class="text-gray-600">
            <span class="font-bold">Contact Information:</span> {{ $restaurant->contactInformation }}
        </p>

        <!-- Operating Hours -->
        <p class="text-gray-600">
            <span class="font-bold">Operating Hours:</span> {{ $restaurant->operatingHours }}
        </p>

        <!-- Menu Link -->
        <!-- Add route('menus.show', ['restaurant' => $restaurant->id]) -->
        <a class="mt-4 text-blue-500 hover:underline" href="{{route('menuItems.index', ['id' => $restaurant->id])}}">View Menu</a>

        <!-- User-specific Links (Logged In) -->
        @auth
        <div class="mt-4 space-x-4">
            <!-- Edit Restaurant Link -->
            <!-- Add route('restaurants.edit', ['restaurant' => $restaurant->id]) -->
            <a class="text-blue-500 hover:underline" href="#">Edit Restaurant</a>

            <!-- Delete Restaurant Form -->
            <!-- Add route('restaurants.destroy', ['restaurant' => $restaurant->id]) -->
            <form action="#" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Delete Restaurant</button>
            </form>
        </div>
        @endauth

    </div>

</x-site-layout>