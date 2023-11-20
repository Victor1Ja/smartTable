<x-site-layout title="Welcome" >

    <h2 class="font-bold">All Restaurants </h2>
    <div class="grid grid-cols-3 gap-4">
        @foreach($restaurants as $restaurant)
            <div>
                {{$restaurant->name }}
            </div>
        @endforeach
    </div>
</x-site-layout>
