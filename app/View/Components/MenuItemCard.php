<?php

namespace App\View\Components;

use App\Models\Cart;
use App\Models\MenuItem;
use Illuminate\View\Component;

class MenuItemCard extends Component
{
    public MenuItem $menuItem;
    public $amount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(MenuItem $menuItem)
    {
        $this->menuItem = $menuItem;
        // $this->amount = Cart::getAll()->where('menu_item_id', $menuItem->id)->first()->amount;
        // on array
        $this->amount = Cart::amountItem($menuItem->id);
    }

    public function reRender()
    {
        $this->amount = Cart::amountItem($this->menuItem->id);

        return $this->render();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $menuItem = $this->menuItem;
        $amount = $this->amount;
        return view('Components.menu-item-card', compact('menuItem', 'amount'));
    }

    /**
     * Subtract a unit from the cart.
     *
     * @param  string  $id
     * @return void
     */
    public function subtractToCart($id)
    {
        // Placeholder function, implement your logic here
        // Example: decrement quantity in the shopping cart
        // ShoppingCart::decrement($id);
        Cart::removeOne($id);
        $this->reRender();
    }

    /**
     * Add a unit to the cart.
     *
     * @param  string  $id
     * @return void
     */
    public function addToState()
    {
        Cart::addItem($this->menuItem);
        $this->reRender();
    }

    /**
     * Add the item to the order.
     *
     * @param  string  $id
     * @return void
     */
    public function addToOrder($id)
    {
        // Placeholder function, implement your logic here
        // Example: add the item to the order
        // Order::addItem($id);

    }
}
