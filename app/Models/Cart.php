<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cart extends Model
{
    use HasFactory;
    public static function getAll(Request $request)
    {
        // Retrieve cart items from the session
        $cartItems = $request->session()->get('cart', []);

        return $cartItems;
    }

    public static function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve cart items from the session
        $cartItems = $request->session()->get('cart', []);
        $price = MenuItem::find($request->menu_item_id)->price;
        // Add the new item to the cart
        $cartItems[] = [
            'menu_item_id' => $request->menu_item_id,
            'quantity' => $request->quantity,
            'price' =>  $price
        ];

        // Store the updated cart items back to the session
        $request->session()->put('cart', $cartItems);

        return $cartItems;
    }

    public static function remove(Request $request, $index)
    {
        // Retrieve cart items from the session
        $cartItems = $request->session()->get('cart', []);

        // Remove the item from the cart
        unset($cartItems[$index]);

        // Store the updated cart items back to the session
        $request->session()->put('cart', array_values($cartItems));

        return $cartItems;
    }
}
