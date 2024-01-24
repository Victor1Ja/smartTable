<?php

namespace App\Livewire;

use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\On;
use Livewire\Component;

class CartComponent extends Component
{
    protected CartService $cartService;
    protected $total;
    protected $content;
    public $table_id = 1;

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
        $this->updateCart();
    }
    /**
     * Renders the component on the browser.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('livewire.cart-component', [
            'total' => $this->total,
            'content' => $this->content,
        ]);
    }
    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id): void
    {
        $this->cartService->remove($id);
        $this->updateCart();
    }
    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        $this->cartService->clear();
        $this->updateCart();
    }
    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        $this->cartService->update($id, $action);
        $this->updateCart();
    }
    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart()
    {
        ray('updateCart');
        $this->total = $this->cartService->total();
        $this->content = $this->cartService->getContent();
        $this->dispatch('$refresh');
    }

    #[On('new-item-added-to-cart')]
    public function refreshCart()
    {
        ray('updateCart');
        $this->updateCart();
        $this->dispatch('$refresh');
    }

    public function buyCart()
    {
        $this->cartService->buy($this->table_id);
        $this->updateCart();
    }
}
