<div x-data="{ open: false }">
    <!-- <button @click="open = !open" class="text-blue-500">Shopping Cart</button> -->
    <button @click="open = !open" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
        <span class="absolute -inset-1.5"></span>
        <span class="sr-only">View notifications</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <circle cx="9" cy="21" r="1" />
            <circle cx="20" cy="21" r="1" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M1 1h4l2.68 13.39a2 2 0 0 0 1.92 1.61h10.8a2 2 0 0 0 1.92-1.61L23 6H6" />
        </svg>
    </button>
    <div x-show="open" @click.away="open = false" class="absolute w-96 bg-white p-4 mt-4 right-40 border rounded shadow-lg z-10">
        <h2 class="font-bold">Shopping Cart</h2>

        @if ($content->count() === 0)
        <p>Your cart is empty.</p>
        @else
        <ul>
            @foreach ($content as $id => $item)
            <p class="text-2xl text-right mb-2 ">
                <button class="text-sm p-2 border-2 rounded border-gray-200 hover:border-gray-300 bg-gray-200 hover:bg-gray-300" wire:click="updateCartItem({{ $id }}, 'minus')"> - </button>
                {{ $item->get('name') }} x {{ $item->get('quantity') }} : {{ $item->get('price')}}$
                <button class="text-sm p-2 border-2 rounded border-gray-200 hover:border-gray-300 bg-gray-200 hover:bg-gray-300" wire:click="updateCartItem({{ $id }}, 'plus')"> + </button>
                <button class="text-sm p-2 border-2 rounded border-gray-500 hover:border-gray-600 bg-gray-500 hover:bg-gray-600" wire:click="removeFromCart({{ $id }})">Remove</button>
            </p>
            @endforeach
        </ul>
        <hr class="my-2">
        <p class="text-xl text-right mb-2">Total: ${{ $total }}</p>
        <button class="w-full p-2 border-2 rounded border-gray-500 hover:border-gray-600 bg-gray-500 hover:bg-gray-600" wire:click="clearCart">Clear Cart</button>
        <!-- Add buy button here-->
        <button class="w-full p-2 mt-2 border-2 rounded border-gray-500 hover:border-gray-600 bg-gray-500 hover:bg-gray-600" wire:click="buyCart">Buy</button>
        @endif
    </div>
</div>