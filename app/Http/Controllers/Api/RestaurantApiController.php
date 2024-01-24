<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;

class RestaurantApiController extends Controller
{

    // Index method to list all Restaurants
    public function index()
    {
        $Restaurants = Restaurant::paginate(10);
        return RestaurantResource::collection($Restaurants);
    }


    // Show method to display a specific Restaurant
    public function show($id)
    {
        try {
            $Restaurant = Restaurant::findOrFail($id);
            return new RestaurantResource($Restaurant);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Restaurant not found'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantRequest $request)
    {
        try {
            $Restaurant = Restaurant::create($request->all());
            return new RestaurantResource($Restaurant);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Restaurant not created'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $Restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantUpdateRequest $request)
    {

        try {
            $Restaurant = Restaurant::findOrFail($request->id);
            $Restaurant->update($request->all());
            return new RestaurantResource($Restaurant);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Restaurant not updated'
            ], 500);
        }
    }
    // Delete method to remove a specific Restaurant
    public function destroy($id)
    {
        try {
            ray($id);
            Restaurant::destroy($id);
            return response()->json([
                'message' => 'Restaurant deleted'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Restaurant not deleted'
            ], 500);
        }
    }
}
