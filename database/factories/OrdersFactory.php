<?php

namespace Database\Factories;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Orders::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tableID' => $this->faker->numberBetween(1, 100),
            'userID' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed']),

            // 'staffID' => null, // Uncomment if staff ID is nullable
        ];
    }
}
