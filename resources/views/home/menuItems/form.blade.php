<x-site-layout title="{{ isset($menuItem) ? 'Edit Menu Item' : 'Create New Menu Item' }}">

    <form action="{{ isset($menuItem) ? route('home.menuItems.update', ['menuItem' => $menuItem->id]) : route('home.menuItems.store') }}" method="post" enctype="multipart/form-data">

        @csrf

        @if(isset($menuItem))
        @method('PUT')
        @endif

        <!-- Restaurant ID (Hidden Input) -->
        <input type="hidden" name="restaurantID" value="{{$restaurantID}}" />

        <!-- Menu Item Name -->
        <x-input-field name="name" label="Menu Item Name" placeholder="Enter menu item name" value="{{ isset($menuItem) ? $menuItem->name : '' }}" />

        <br />

        <!-- Description -->
        <x-textarea-field name="description" label="Description" placeholder="Enter menu item description" value="{{ isset($menuItem) ? $menuItem->description : '' }}" />

        <br />

        <!-- Price -->
        <x-input-field name="price" label="Price" placeholder="Enter price" value="{{ isset($menuItem) ? $menuItem->price : '' }}" />

        <br />

        <!-- Category -->
        <x-input-field name="category" label="Category" placeholder="Enter category" value="{{ isset($menuItem) ? $menuItem->category : '' }}" />

        <br />

        <!-- Image -->
        <label for="image">Image</label>
        <input name="image" type="file" />

        <br />

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ isset($menuItem) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>

</x-site-layout>