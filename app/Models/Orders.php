<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return $this->hasMany(OrderItem::class, 'orderID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public static function getAllOrders()
    {
        // Retrieve all orders with their items
        return Orders::with(['orderItems', 'orderItems.menuItem'])->get();
    }

    public static function getOrderWithItemsById($id)
    {
        // Load the order with its items by ID
        return Orders::with(['orderItems', 'orderItems.menuItem'])->findOrFail($id);
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

    public static function addItemToOrder(int $OrderId, int $menuItemId)
    {

        // Validation rules for adding an item

        $order = Orders::with('orderItems')->findOrFail($OrderId);
        if ($order->status !== 'pending') {
            throw new \Exception('Cannot add an item to an order that is not pending');
        }

        // Check if the user is an admin or the owner of the order
        $user = Auth::user();
        if (!$user->is_admin && $user->id !== $order->userID) {
            throw new \Exception('Cannot Add an item from an order that is not yours');
        }

        // Check if the item already exists in the order
        foreach ($order->orderItems as $orderItem) {
            if ($orderItem->menu_item_id == $menuItemId) {
                $orderItem->update([
                    'quantity' => $orderItem->quantity + 1,
                ]);
                return $order;
            }
        }
        $menuItem = MenuItem::findOrFail($menuItemId);

        // If the item does not exist, create a new order item
        $orderItem = $order->orderItems()->create([
            'menu_item_id' =>  $menuItemId,
            'quantity' => 1,
            'status' => 'pending', // Set the default status
        ]);

        return $orderItem;
    }

    public static function removeItemToOrder($orderId, $menuItemId)
    {
        // Validation rules for removing an item

        // Find the order item
        $orderItem = OrderItem::with('order')->where('orderID', $orderId)->where('menu_item_id', $menuItemId)->firstOrFail();
        if ($orderItem->order->status !== 'pending') {
            throw new \Exception('Cannot remove an item from an order that is not pending');
        }

        // Check if the user is an admin or the owner of the order
        $user = Auth::user();
        if (!$user->is_admin && $user->id !== $orderItem->order->userID) {
            throw new \Exception('Cannot remove an item from an order that is not yours');
        }

        // Check if the item already exists in the order
        if ($orderItem->quantity > 1) {
            $orderItem->update([
                'quantity' => $orderItem->quantity - 1,
            ]);
            return $orderItem;
        } else {
            $orderItem->delete();
        }


        return $orderItem;
    }

    public static function updateItemStatus(OrderItem $orderItem, Request $request)
    {
        // Validation rules for updating an item status
        $request->validate([
            'status' => 'in:pending,processing,completed',
        ]);

        // Update the order item status
        $orderItem->update([
            'status' => $request->input('status'),
        ]);

        return $orderItem;
    }

    public static function getCurrentOrder()
    {
        // Get the current order
        $user = Auth::user();
        $order = Orders::with('orderItems')->where('userID', $user->id)->whereNot('status', 'completed')->first();
        // if (!$order) {
        //     throw new \Exception('No pending order found');
        // }
        return $order;
    }
}
