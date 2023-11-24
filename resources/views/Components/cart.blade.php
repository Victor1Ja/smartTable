<!-- resources/views/cart/index.blade.php -->

<x-site-layout title="Shopping Cart">

    <h2 class="font-bold">Shopping Cart</h2>

    @if($cartItems->isEmpty())
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

</x-site-layout>