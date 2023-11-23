<x-site-layout title="{{ isset($restaurant) ? 'Edit Restaurant' : 'Create New Restaurant' }}">

    <form action="{{ isset($restaurant) ? route('home.restaurants.update', ['restaurant' => $restaurant->id]) : route('home.restaurants.store') }}" method="post" enctype="multipart/form-data">

        @csrf

        @if(isset($restaurant))
        @method('PUT')
        @endif

        <!-- Restaurant Name -->
        <x-input-field name="name" label="Restaurant Name" placeholder="Enter restaurant name" value="{{ isset($restaurant) ? $restaurant->name : '' }}" />

        <br />

        <!-- Location -->
        <x-input-field name="location" label="Location" placeholder="Enter location" value="{{ isset($restaurant) ? $restaurant->location : '' }}" />

        <br />

        <!-- Contact Information -->
        <x-input-field name="contactInformation" label="Contact Information" placeholder="Enter contact information" value="{{ isset($restaurant) ? $restaurant->contactInformation : '' }}" />

        <br />

        <!-- Operating Hours -->
        <x-input-field name="operatingHours" label="Operating Hours" placeholder="Enter operating hours" value="{{ isset($restaurant) ? $restaurant->operatingHours : '' }}" />

        <br />

        <!-- Logo Image -->
        <label for="image">Logo Image</label>
        <input name="image" type="file" />

        <br />

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ isset($restaurant) ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>

</x-site-layout>