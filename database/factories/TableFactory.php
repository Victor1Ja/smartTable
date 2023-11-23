<?php

namespace Database\Factories;

use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $restaurantId = $this->faker->randomDigitNotZero;
        $tablesAmount = Table::where('restaurantID', $restaurantId)->count();
        return [
            'restaurantID' => $restaurantId,
            'number' => $this->faker->numberBetween(1, 100),
            'location' => $this->faker->word,
        ];
    }
}
