<x-site-layout title="Restaurants">

    <h2 class="font-bold">All Restaurants </h2>
    <div class="grid grid-cols-3 gap-4">
        @foreach($restaurants as $restaurant)
        <x-simple-card imageUrl="https://via.placeholder.com/640x480.png/00ff77?text=No+Image" :title="$restaurant->name" url="{{route('restaurants.show',['id'=> $restaurant->restaurantID ])}}" subtitle='' />
        @endforeach
    </div>
</x-site-layout>