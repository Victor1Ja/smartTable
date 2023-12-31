<x-site-layout title="MenuItems">
    <div class="flex justify-between items-center mt-4">
        <h2 class="font-bold">All Offers </h2>

        {{-- Add New MenuItems Button for Admin --}}
        @auth
        @if(auth()->user()->is_admin)
        <a href="{{route('home.menuItems.create', ['restaurantID' => $restaurantId])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New MenuItem
        </a>
        @endif
        @endauth
    </div>
    <br />
    <div class="grid grid-cols-3 gap-4">
        @foreach($menuItems as $menuItem)
        <x-simple-card svg='' imageUrl="https://via.placeholder.com/640x480.png/00ff77?text=No+Image" :title="$menuItem->name" url="{{route('menuItems.show',['id'=> $menuItem->id ])}}" subtitle="Price:{{$menuItem->price}}$" />
        @endforeach
    </div>
</x-site-layout>