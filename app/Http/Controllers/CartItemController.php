<?php

// app/Http/Controllers/CartItemController.php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartItemController extends Controller
{

    public function index(Request $request)
    {
        // Retrieve cart items from the session
        $cartItems = Cart::getAll($request);

        return view('cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {

        $cartItems = Cart::store($request);

        return redirect()->route('cart.index')->with('success', 'Item added to the cart successfully.');
    }

    public function destroy(Request $request, $index)
    {
        // Retrieve cart items from the session
        $cartItems = Cart::destroy($request, $index);

        return redirect()->route('cart.index')->with('success', 'Item removed from the cart successfully.');
    }
}
