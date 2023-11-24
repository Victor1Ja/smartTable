{{-- resources/views/orders/view.blade.php --}}

<x-site-layout title="View Order">
    <h2 class="font-bold">Order Details</h2>

    <p>Status: {{ $order->status }}</p>
    {{-- Add other order details as needed --}}

    <h2 class="font-bold mt-4">Order Items</h2>

    @if ($order->orderItems->isNotEmpty())
    <ul>
        @foreach ($order->orderItems as $item)
        <li>
            {{ $item->menu_item->name }} - Quantity: {{ $item->quantity }} - Status: {{ $item->status }}
            {{-- Add other order item details as needed --}}
        </li>
        @endforeach
    </ul>
    @else
    <p>No items in this order.</p>
    @endif
</x-site-layout>