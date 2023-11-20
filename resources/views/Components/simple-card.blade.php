<!-- resources/views/components/card.blade.php -->

<div class="bg-white p-4 shadow-md rounded-md">
    <img src="{{ $imageUrl }}" alt="Card Image" class="w-full h-32 object-cover mb-4 rounded-md">
    <h2 class="text-xl font-semibold text-gray-800">{{ $title }}</h2>
    <p class="text-sm text-gray-600">{{ $subtitle }}</p>
    <a href="{{$url}}" class="mt-2 text-blue-500 hover:underline">View</a>
</div>