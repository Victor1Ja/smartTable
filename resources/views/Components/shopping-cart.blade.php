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
    <div x-show="open" @click.away="open = false" class="absolute bg-white p-4 mt-2 border rounded shadow-lg">
        <h2 class="font-bold">Shopping Cart</h2>

        @if(count($cartItems) === 0)
        <p>Your cart is empty.</p>
        @else
        <ul>
            @foreach($cartItems as $cartItem)
            <li>
                {{ $cartItem->menu_item->name }} - Quantity: {{ $cartItem->quantity }} - Price: ${{ $cartItem->price }}
                <form action="{{ route('cart.destroy', $cartItem) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Remove from Cart</button>
                </form>
            </li>
            @endforeach
        </ul>
        <!-- Add checkout button or additional cart functionality here -->
        @endif
    </div>
</div>