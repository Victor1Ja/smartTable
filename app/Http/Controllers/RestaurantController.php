<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    // Index method to list all restaurants
    public function index()
    {
        $restaurants = Restaurant::with(['media'])->get();

        return view('home.restaurants.index', compact('restaurants'));
    }

    // Show method to display a specific restaurant
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return view('home.restaurants.show', compact('restaurant'));
    }

    // Create method to show the create form
    public function create()
    {
        return view('home.restaurants.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'location' => ['required', 'min:3', 'max:255'],
            'contactInformation' => ['required', 'min:5', 'max:255'],
            'operatingHours' => ['required', 'min:5', 'max:255'],

        ]);

        $restaurant = Restaurant::create([
            'name' => $request->name,
            'location' => $request->location,
            'contactInformation' => $request->contactInformation,
            'operatingHours' => $request->operatingHours,
        ]);
        if ($request->hasFile('image')) {
            $restaurant->addMediaFromRequest('image')->toMediaCollection();
        }

        return redirect()->route('restaurants.show', ['id' => $restaurant->id])
            ->with('success', 'Restaurant created successfully');
    }

    // Edit method to show the edit form
    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        return view('home.restaurants.form', compact('restaurant'));
    }

    // Update method to update a specific restaurant
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);

        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'location' => ['required', 'min:3', 'max:255'],
            'contactInformation' => ['required', 'min:5', 'max:255'],
            'operatingHours' => ['required', 'min:5', 'max:255'],
            // 'image' => ['file'],
        ]);

        // $imagePath = null;

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('restaurant_images', 'public');
        // }

        $restaurant->update([
            'name' => $request->name,
            'location' => $request->location,
            'contactInformation' => $request->contactInformation,
            'operatingHours' => $request->operatingHours,
            // 'image_path' => $imagePath
            // Add more fields as needed
        ]);

        return redirect()->route('restaurants.show', ['id' => $restaurant->id])
            ->with('success', 'Restaurant updated successfully');
    }

    // Delete method to remove a specific restaurant
    public function destroy($id)
    {
        // Delete logic here
    }
}
