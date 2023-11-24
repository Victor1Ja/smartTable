<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Orders;
use App\Models\User;
use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Restaurant::factory(10)->create();
        \App\Models\Table::factory(100)->create();
        \App\Models\MenuItem::factory(100)->create();
        Orders::factory(10)->create();

        User::create([
            'name' => 'Victor',
            'email' => 'email@test.com',
            'password' => '$2y$12$UuNczBX1AYKj9EHXnN9pUefUvexe4RjIPjaZ6kVAMFPIiG.iJQsWK', //12345678
            'is_admin' => true,
        ]);
    }
}
