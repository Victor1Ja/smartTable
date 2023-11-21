<x-site-layout title="TABLE - {{ $table->number }}">

    <!-- Back to Restaurant Link -->
    <a class="underline" href="{{ route('restaurants.show', ['id' => $table->id])}}">Back to Restaurant</a>

    <!-- Table Details Section -->
    <div class="mt-4">
        <!-- Table Number -->
        <h1 class="text-2xl font-bold">Table {{ $table->number }}</h1>

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
                <x-simple-card svg='' imageUrl="https://via.placeholder.com/640x480.png/00ff77?text=No+Image" :title="$menuItem->name" url="{{route('menuItems.show',['id'=> $menuItem->id ])}}" subtitle="Price:{{$menuItem->price}}$" />
                @endforeach
            </div>
            @endif
        </div>

        <!-- Additional Details (if needed) -->

    </div>

</x-site-layout>