<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Models\Orders;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShoppingCart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $cartItems = Orders::getCurrentOrder()->menuItems ?? [];
        return view('Components.shopping-cart', compact('cartItems'));
    }
}
