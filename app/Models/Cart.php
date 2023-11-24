<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cart extends Model
{
    use HasFactory;
    public static function getAll()
    {
        // Retrieve cart items from the session
        $cartItems = session()->get('cart', []);

        return $cartItems;
    }

    public static function clear()
    {
        // Clear all cart items from the session
        session()->forget('cart');
    }

    public static function amountItem($id)
    {
        $cartItems = session()->get('cart', []);
        $amount = 0;
        foreach ($cartItems as $cartItem) {
            if ($cartItem['menu_item_id'] == $id) {
                $amount = $cartItem['quantity'];
                break;
            }
        }
        return $amount;
    }

    public static function addItem($item)
    {
        if ($item->quantity == 0) {
            throw new \Exception('Quantity must be greater than 0');
        }


        // Retrieve cart items from the session
        $cartItems = session()->get('cart', []);
        $menuItem = MenuItem::find($item->menu_item_id);
        if ($menuItem == null) {
            throw new \Exception('Menu item not found');
        }

        if ($cartItems != null) {
            foreach ($cartItems as $cartItem) {
                if ($cartItem['menu_item_id'] == $item->menu_item_id) {
                    $cartItem['quantity'] += $item->quantity;
                    $cartItem['price'] = $cartItem['quantity'];
                    break;
                }
            }
        } else {
            $cartItems[] = [
                'menu_item_id' => $item->menu_item_id,
                'quantity' => $item->quantity,
                'price' =>  $menuItem->price
            ];
        }
        // Store the updated cart items back to the session
        session()->put('cart', $cartItems);

        return $cartItems;
    }

    public static function removeOne($index)
    {
        // Retrieve cart items from the session
        $cartItems = session()->get('cart', []);

        // Remove one the item from the cart
        if (isset($cartItems[$index])) {
            $cartItems[$index]['quantity'] -= 1;
        }
        if ($cartItems[$index]['quantity'] == 0) {
            unset($cartItems[$index]);
        }
        // Store the updated cart items back to the session
        session()->put('cart', array_values($cartItems));

        return $cartItems;
    }
}
