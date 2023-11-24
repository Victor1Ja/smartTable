<x-site-layout title="Orders">

    <h2 class="font-bold">All Orders</h2>

    @if(count($orders) > 0)
    <div class="grid grid-cols-3 gap-4">
        @foreach($orders as $order)
        <div class="bg-white p-4 shadow-md rounded-md">
            <h3 class="text-lg font-semibold text-gray-800">Order #{{ $order->id }}</h3>
            <p class="text-sm text-gray-600">Status: {{ ucfirst($order->status) }}</p>

            <!-- Display Order Items -->
            <ul>
                @foreach($order->orderItems as $item)
                <li>{{ $item->quantity }}x {{ $item->menu_item->name }}</li>
                @endforeach
            </ul>

            <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="text-blue-500 hover:underline">View Details</a>
        </div>
        @endforeach
    </div>
    @else
    <p>No orders available.</p>
    @endif

</x-site-layout>