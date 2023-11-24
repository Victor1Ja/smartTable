<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'tableID',
        'status',
        // 'staffID', // Uncomment if staff ID is nullable
    ];

    // Define the relationship with the RestaurantTable model
    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'tableID');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id');
    }

    public static function getAllOrders()
    {
        // Retrieve all orders with their items
        return Orders::with('orderItems')->get();
    }

    public static function getOrderWithItemsById($id)
    {
        // Load the order with its items by ID
        return Orders::with('orderItems')->findOrFail($id);
    }

    public static function createOrder()
    {
        // Create a new order
        return Orders::create([
            'status' => 'pending',
            // Add any additional fields as needed
        ]);
    }

    public  static function updateOrderStatus(Orders $order, Request $request)
    {
        // Validation rules
        $request->validate([
            'status' => 'in:pending,processing,completed',
        ]);

        // Update the order status
        $order->update([
            'status' => $request->input('status'),
        ]);

        return $order;
    }

    public static function deleteOrder($id)
    {
        $order = Orders::findOrFail($id);
        if ($order->status !== 'pending') {
            throw new \Exception('Cannot delete an order that is not pending');
        }
        // Delete the order
        $order->delete();
        return $order;
    }

    public static function addItemToOrder(Orders $order, Request $request)
    {
        // Validation rules for adding an item
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
            // Add any additional rules as needed
        ]);

        // Create a new order item
        $order->items()->create([
            'menu_item_id' => $request->input('menu_item_id'),
            'quantity' => $request->input('quantity'),
            'status' => 'pending', // Set the default status
            // Add any additional fields as needed
        ]);

        return $order;
    }

    public static function removeItemToOrder($id)
    {
        // Validation rules for removing an item

        // Find the order item
        $orderItem = OrderItem::with('order')->findOrFail($id);
        if ($orderItem->order->status !== 'pending') {
            throw new \Exception('Cannot remove an item from an order that is not pending');
        }

        $orderItem->delete();

        return $orderItem;
    }
}
