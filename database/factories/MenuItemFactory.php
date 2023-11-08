<?php

namespace Database\Factories;

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
            'restaurantID' => $this->faker->randomDigit,
            'name' => $this->faker->word,
            'description' => $this->faker->word,
            'price' => $this->faker->randomDigit,
            'category' => $this->faker->word,
            'image' => $this->faker->word,
        ];
    }
}
