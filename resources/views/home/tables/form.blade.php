<x-site-layout title="{{ isset($table) ? 'Edit Restaurant Table' : 'Create New Restaurant Table' }}">

    <form action="{{ isset($table) ? route('home.tables.update', ['table' => $table->id]) : route('home.tables.store') }}" method="post">

        @csrf

        @if(isset($table))
        @method('PUT')
        @endif

        <!-- Restaurant ID (Hidden Input) -->
        <input type="hidden" name="restaurant_id" value="{{ isset($table) ? $table->id : $restaurantId }}" />

        <!-- Table Number -->
        <x-input-field name="number" label="Table Number" placeholder="Enter table number" value="{{ isset($table) ? $table->number : '' }}" />

        <br />

        <!-- Location -->
        <x-input-field name="location" label="Location" placeholder="Enter location" value="{{ isset($table) ? $table->location : '' }}" />

        <br />

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ isset($table) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>

</x-site-layout>