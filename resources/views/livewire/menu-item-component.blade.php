<div class="bg-white p-4 shadow-md rounded-md">
    @if ($menuItem->media->first())
    <img src="{{$menuItem->getImageUrl('preview')}}" alt="Menu Item Image" class="w-full h-32 object-cover mb-4 rounded-md">
    @endif
    <h2 class="text-xl font-semibold text-gray-800">{{ $menuItem->name }}</h2>
    <p class="text-sm text-gray-600">${{ $menuItem->price }}</p>

    <div class="flex items-center mt-4">
        <button class="bg-gray-200 px-2 py-1 rounded-md" wire:click="decrementQuantity">-</button>
        <input class="mx-2 border-2" wire:model.live="quantity" min="1" type="number">
        <button class="bg-gray-200 px-2 py-1 rounded-md" wire:click="incrementQuantity">+</button>
    </div>

    <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" wire:click="addToCart">Add to Order</button>
</div>