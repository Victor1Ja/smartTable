<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    // Index method to list all restaurants
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    // Show method to display a specific restaurant
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurants.show', compact('restaurant'));
    }

    // Create method to show the create form
    public function create()
    {
        return view('restaurants.create');
    }

    // Store method to save a new restaurant
    public function store(Request $request)
    {
        // Validation and store logic here
    }

    // Edit method to show the edit form
    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        return view('restaurants.edit', compact('restaurant'));
    }

    // Update method to update a specific restaurant
    public function update(Request $request, $id)
    {
        // Validation and update logic here
    }

    // Delete method to remove a specific restaurant
    public function destroy($id)
    {
        // Delete logic here
    }
}
