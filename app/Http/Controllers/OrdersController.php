<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Orders::getAllOrders();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Orders::getOrderWithItemsById($id);

        $orderItems = $order->orderItems;
        $total = 0;
        foreach ($orderItems as $item) {
            $total += $item->menuItem->price * $item->quantity;
        }

        return view('admin.orders.show', compact('order', 'orderItems', 'total'));
    }

    public function create()
    {
        $order = Orders::createOrder();

        return redirect()->route('admin.orders.edit', ['order' => $order->id]);
    }

    public function edit(Orders $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->route('admin.orders.index')->with('error', 'Only pending orders can be edited.');
        }

        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Orders $order)
    {
        $updatedOrder = Orders::updateOrderStatus($order, $request);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Orders $order)
    {
        Orders::deleteOrder($order);

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    public function addItem(int $orderId, int $menuItemId)
    {
        $updatedOrder = Orders::addItemToOrder($orderId,  $menuItemId);

        return back();
    }
    public function removeItem(int $orderId, int $menuItemId)
    {
        $updatedOrder = Orders::removeItemToOrder($orderId, $menuItemId);

        return back();
    }
}
