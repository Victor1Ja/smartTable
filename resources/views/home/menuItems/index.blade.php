<x-site-layout title="MenuItems">

    <h2 class="font-bold">All Offers </h2>
    <div class="grid grid-cols-3 gap-4">
        @foreach($menuItems as $menuItem)
        <x-simple-card imageUrl="https://via.placeholder.com/640x480.png/00ff77?text=No+Image" :title="$menuItem->name" url="{{route('menuItems.show',['id'=> $menuItem->id ])}}" subtitle='' />
        @endforeach
    </div>
</x-site-layout>