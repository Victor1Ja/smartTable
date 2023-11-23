<x-site-layout title="MENU ITEM - {{ $menuItem->name }}">

    <!-- Back to Menu Link -->
    <a class="underline" href="{{ route('menuItems.index', ['id' => $menuItem->restaurant->id]) }}">Back to Menu</a>

    <!-- Menu Item Details Section -->
    <div class="mt-4">
        <!-- Name -->
        <h1 class="text-2xl font-bold">{{ $menuItem->name }}</h1>

        <!-- Description -->
        <p class="text-gray-600 mt-2">
            <span class="font-bold">Description:</span> {{ $menuItem->description }}
        </p>

        <!-- Price -->
        <p class="text-gray-600">
            <span class="font-bold">Price:</span> ${{ number_format($menuItem->price, 2) }}
        </p>

        <!-- Category -->
        <p class="text-gray-600">
            <span class="font-bold">Category:</span> {{ $menuItem->category }}
        </p>

        <!-- Additional Details (if needed) -->

        <!-- User-specific Links (Logged In) -->
        @auth
        <div class="mt-4 space-x-4">
            <!-- Edit Menu Item Link -->
            <!-- route('menuItems.edit', ['menuItem' => $menuItem->id]) -->
            <a class="text-blue-500 hover:underline" href="{{route('home.menuItems.edit', ['menuItem' => $menuItem->id])}}">Edit Menu Item</a>

            <!-- Delete Menu Item Form -->
            <!--  route('menuItems.destroy', ['menuItem' => $menuItem->id])  -->
            <form action="#" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Delete Menu Item</button>
            </form>
        </div>
        @endauth

    </div>

</x-site-layout>