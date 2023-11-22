<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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

        User::create([
            'name' => 'Victor',
            'email' => 'email@test.com',
            'password' => '$2y$12$NcMAoaOmrpeQ124puIArRuEz8C35sBWw3e5YlsYZYO7ixpNaa7Qzi',
            'is_admin' => true,
        ]);
    }
}
