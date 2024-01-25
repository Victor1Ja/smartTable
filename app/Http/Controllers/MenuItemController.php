<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    // Index method to list all menu items
    public function index($restaurantId)
    {
        $menuItems = MenuItem::with('media')->where('restaurant_id', $restaurantId)->get();
        return view('home.menuItems.index', compact('menuItems', 'restaurantId'));
    }

    // Show method to display a specific menu item
    public function show($id)
    {
        $menuItem = MenuItem::find($id)->loadMissing('restaurant');
        return view('home.menuItems.show', compact('menuItem'));
    }

    // Create method to show the create form
    public function create(Request $request)
    {
        $restaurant_id = $request->restaurant_id;
        return view('home.menuItems.form', compact('restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id', // Ensure the restaurant exists
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload
        ]);


        // Handle image upload if provided
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('menu_item_images', 'public');
        // }
        $menuItem = MenuItem::create([
            'restaurant_id' => $request->restaurant_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        if ($request->hasFile('image')) {
            $menuItem->addMediaFromRequest('image')->toMediaCollection();
        }
        return redirect()->route('menuItems.show', ['id' => $menuItem->id])->with('success', 'Menu item created successfully.');
    }



    // Edit method to show the edit form
    public function edit($id)
    {
        $menuItem = MenuItem::find($id);
        return view('home.menuItems.form', compact('menuItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload
        ]);


        // Handle image upload if provided
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('menu_item_images', 'public');
        // }

        $menuItem->update($request->all());
        return redirect()->route('menuItems.show', ['id' => $menuItem->id])->with('success', 'Menu item updated successfully.');
    }

    // Delete method to remove a specific menu item
    public function destroy($id)
    {
        // Delete logic here
    }
}
