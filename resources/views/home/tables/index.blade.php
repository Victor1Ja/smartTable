<x-site-layout title="Tables">

    <div class="flex justify-between items-center mt-4">
        <h2 class="font-bold">All Tables </h2>

        {{-- Add New Table Button for Admin --}}
        @auth
        @if(auth()->user()->is_admin)
        <a href="{{route('home.tables.create', ['restaurant_id' => $restaurantId])}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Table
        </a>
        @endif
        @endauth
    </div>
    <div class="grid grid-cols-3 gap-4">
        @foreach($tables as $table)
        <x-simple-card svg="{{$table->svgQr}}" imageUrl='' title="Table Number: {{$table->number}}" url="{{route('tables.show',['id'=> $table->id ])}}" subtitle='' />
        @endforeach
    </div>
</x-site-layout>