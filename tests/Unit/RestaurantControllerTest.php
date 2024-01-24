<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Restaurant;

class RestaurantControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        // Create some dummy restaurants
        Restaurant::factory()->count(5)->create();

        // Make a GET request to the index endpoint
        $response = $this->get('/api/restaurants');

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the response contains the correct number of restaurants
        $response->assertJsonCount(5, 'data');
    }

    /**
     * Test the show method.
     *
     * @return void
     */
    public function testShow()
    {
        // Create a dummy restaurant
        $restaurant = Restaurant::factory()->create();

        // Make a GET request to the show endpoint
        $response = $this->get('/api/restaurants/' . $restaurant->id);

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the response contains the correct restaurant data
        $response->assertJson([
            'data' => [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'location' => $restaurant->location,
                'contactInformation' => $restaurant->contactInformation,
                'operatingHours' => $restaurant->operatingHours,
            ]
        ]);
    }

    /**
     * Test the store method.
     *
     * @return void
     */
    public function testStore()
    {
        // Create dummy data for a new restaurant
        $data = [
            'name' => 'Test Restaurant',
            'location' => 'Test Location',
            'contactInformation' => 'Test Contact Information',
            'operatingHours' => 'Test Operating Hours',
        ];

        // Make a POST request to the store endpoint with the dummy data
        $response = $this->post('/api/restaurants', $data);

        // Assert that the response has a successful status code
        $response->assertStatus(201);

        // Assert that the response contains the correct restaurant data
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
                'location' => $data['location'],
                'contactInformation' => $data['contactInformation'],
                'operatingHours' => $data['operatingHours'],
            ]
        ]);

        // Assert that the restaurant was actually created in the database
        $this->assertDatabaseHas('restaurants', $data);
    }

    /**
     * Test the update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        // Create a dummy restaurant
        $restaurant = Restaurant::factory()->create();

        // Create dummy data for updating the restaurant
        $data = [
            'name' => 'Updated Restaurant',
            // Add more attributes as needed
        ];

        // Make a PUT request to the update endpoint with the dummy data
        $response = $this->put('/api/restaurants/' . $restaurant->id, $data);

        // Assert that the response has a successful status code
        $response->assertStatus(200);

        // Assert that the response contains the updated restaurant data
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
                // Add more assertions for other attributes
            ]
        ]);

        // Assert that the restaurant was actually updated in the database
        $this->assertDatabaseHas('restaurants', $data);
    }

    /**
     * Test the destroy method.
     *
     * @return void
     */
    public function testDestroy()
    {
        // Create a dummy restaurant
        $restaurant = Restaurant::factory()->create();
        ray($restaurant);

        // Make a DELETE request to the destroy endpoint
        $response = $this->delete('/api/restaurants/' . $restaurant->id);

        // Assert that the response has a successful status code
        $response->assertStatus(204);
    }
}
