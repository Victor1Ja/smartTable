<x-site-layout title="Tables">

    <h2 class="font-bold">All Tables </h2>
    <div class="grid grid-cols-3 gap-4">
        @foreach($tables as $table)
        <x-simple-card svg="{{$table->svgQr}}" imageUrl='' title="Table Number: {{$table->number}}" url="{{route('tables.show',['id'=> $table->id ])}}" subtitle='' />
        @endforeach
    </div>
</x-site-layout>