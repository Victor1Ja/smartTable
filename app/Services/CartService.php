<?php

namespace App\Services;

use App\Models\OrderItem;
use App\Models\Orders;
use Illuminate\Support\Collection;

class CartService
{
    const MINIMUM_QUANTITY = 1;
    const DEFAULT_INSTANCE = 'shopping-cart';

    protected $instance;

    /**
     * Constructs a new cart object.
     *
     * @param Illuminate\Session\SessionManager $session
     */
    public function __construct()
    {
    }

    /**
     * Adds a new item to the cart.
     *
     * @param string $id
     * @param string $name
     * @param string $price
     * @param string $quantity
     * @param array $options
     * @return void
     */
    public function add($id, $name, $price, $quantity, $options = []): void
    {
        ray($price);
        $cartItem = $this->createCartItem($id, $name, str($price), $quantity, $options);

        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem->put('quantity', $content->get($id)->get('quantity') + $quantity);
        }

        $content->put($id, $cartItem);

        session([self::DEFAULT_INSTANCE => $content]);
    }

    /**
     * Updates the quantity of a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function update(string $id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content->get($id);

            switch ($action) {
                case 'plus':
                    $cartItem->put('quantity', $content->get($id)->get('quantity') + 1);
                    break;
                case 'minus':
                    $updatedQuantity = $content->get($id)->get('quantity') - 1;

                    if ($updatedQuantity < self::MINIMUM_QUANTITY) {
                        $updatedQuantity = self::MINIMUM_QUANTITY;
                    }

                    $cartItem->put('quantity', $updatedQuantity);
                    break;
            }

            $content->put($id, $cartItem);

            session([self::DEFAULT_INSTANCE => $content]);
        }
    }


    /**
     * Clears the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        session([self::DEFAULT_INSTANCE => collect([])]);
    }

    /**
     * Returns total price of the items in the cart.
     *
     * @return string
     */
    public function total(): string
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            return $total += $item->get('price') * $item->get('quantity');
        });

        return number_format($total, 2);
    }

    /**
     * Returns the content of the cart.
     *
     * @return Illuminate\Support\Collection
     */
    public function getContent(): Collection
    {
        return session(self::DEFAULT_INSTANCE) ?? collect([]);
    }

    /**
     * Creates a new cart item from given inputs.
     *
     * @param string $name
     * @param string $price
     * @param string $quantity
     * @param array $options
     * @return Illuminate\Support\Collection
     */
    protected function createCartItem(int $id, string $name, string $price, string $quantity, array $options): Collection
    {
        $price = floatval($price);
        $quantity = intval($quantity);

        if ($quantity < self::MINIMUM_QUANTITY) {
            $quantity = self::MINIMUM_QUANTITY;
        }

        return collect([
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'options' => $options,
        ]);
    }

    function remove($id)
    {
        $content = $this->getContent();
        $content->forget($id);
        session([self::DEFAULT_INSTANCE => $content]);
    }

    function buy(int $table_id)
    {
        $this->clear();
    }
}
