<x-site-layout title="TABLE - {{ $table->number }}">

    <!-- Back to Restaurant Link -->
    <a class="underline" href="{{ route('restaurants.show', ['id' => $table->restaurant_id])}}">Back to Restaurant</a>

    <!-- Table Details Section -->
    <div class="mt-4">
        <div class="flex justify-between items-center mt-4">
            <!-- Table Number -->
            <h1 class="text-2xl font-bold">Table {{ $table->number }}</h1>

            {{-- Add New Table Button for Admin --}}
            @auth
            @if(auth()->user()->is_admin)
            <a href="{{route('home.tables.edit', ['table' => $table->id])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Edit this Table
            </a>
            @endif
            @endauth
        </div>


        <!-- Restaurant Name -->
        <p class="text-gray-600 mt-2">
            <span class="font-bold">Restaurant:</span> {{ $table->restaurant->name }}
        </p>

        <!-- Menu Items List -->
        <div class="mt-4">
            <h2 class="text-xl font-semibold mb-2">Menu Items:</h2>

            @if (!$menuItems)
            <p class="text-gray-600">No menu items available for this table.</p>
            @else
            <div class="grid grid-cols-3 gap-4">
                @foreach ($menuItems as $menuItem)
                <x-menu-item-card :menuItem="$menuItem" />
                @endforeach
            </div>
            @endif
        </div>

        <!-- Additional Details (if needed) -->

    </div>

</x-site-layout>