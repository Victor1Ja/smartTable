<?php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'restaurant_id' => $this->faker->randomDigitNotZero,
            'name' => $this->faker->word,
            'description' => $this->faker->word,
            'price' => $this->faker->randomDigit,
            'category' => $this->faker->word,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (MenuItem $menuitem) {
            return $menuitem;
        });
    }

    // Solution from https://laracasts.com/discuss/channels/testing/how-to-disable-factory-callbacks
    public function withImages(): self
    {
        return $this->afterCreating(function (MenuItem $menuitem) {
            $url = 'https://loremflickr.com/320/240';
            $menuitem
                ->addMediaFromUrl($url)
                ->toMediaCollection("menu-item-images");
        });
    }
}
