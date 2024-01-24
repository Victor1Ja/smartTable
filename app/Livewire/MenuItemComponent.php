<?php

namespace App\Livewire;

use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MenuItemComponent extends Component
{
    private CartService $cartService;
    public $menuItem;
    public $quantity;

    public function __construct()
    {
        $this->cartService = new CartService();
    }
    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->quantity = 1;
    }
    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.menu-item-component');
    }
    /**
     * Adds an item to cart.
     *
     * @return void
     */
    public function addToCart(): void
    {
        $this->cartService->add($this->menuItem->id, $this->menuItem->name, $this->menuItem->price, $this->quantity);
        $this->dispatch('new-item-added-to-cart');
        ray("Added to cart");
    }

    public function incrementQuantity(): void
    {
        $this->quantity++;
    }

    public function decrementQuantity(): void
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
}
