<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'location' => $this->faker->streetAddress,
            'contactInformation' => $this->faker->phoneNumber,
            'operatingHours' => $this->faker->time,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Restaurant $restaurant) {
            return $restaurant;
        });
    }

    // Solution from https://laracasts.com/discuss/channels/testing/how-to-disable-factory-callbacks
    public function withImages(): self
    {
        return $this->afterCreating(function (Restaurant $restaurant) {
            $url = 'https://loremflickr.com/320/240';
            $restaurant
                ->addMediaFromUrl($url)
                ->toMediaCollection("restaurant-images");
        });
    }
}
