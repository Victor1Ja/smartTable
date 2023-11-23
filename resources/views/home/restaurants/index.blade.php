<x-site-layout title="Restaurants">
    <div class="flex justify-between items-center mt-4">
        <h2 class="font-bold">All Restaurants </h2>
        {{-- Add New Restaurant Button for Admin --}}
        @auth
        @if(auth()->user()->is_admin)
        <a href="{{ route('home.restaurants.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Restaurant
        </a>
        @endif
        @endauth
    </div>
    <br />

    <div class="grid grid-cols-3 gap-4">
        @foreach($restaurants as $restaurant)
        <x-simple-card svg='' imageUrl="https://via.placeholder.com/640x480.png/00ff77?text=No+Image" :title="$restaurant->name" url="{{route('restaurants.show',['id'=> $restaurant->id ])}}" subtitle='' />
        @endforeach
    </div>
</x-site-layout>