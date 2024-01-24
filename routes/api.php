<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/restaurants', [\App\Http\Controllers\Api\RestaurantApiController::class, 'index']);
Route::get('/restaurants/{id}', [\App\Http\Controllers\Api\RestaurantApiController::class, 'show']);
Route::post('/restaurants', [\App\Http\Controllers\Api\RestaurantApiController::class, 'store']);
Route::put('/restaurants/{id}', [\App\Http\Controllers\Api\RestaurantApiController::class, 'update']);
Route::delete('/restaurants/{id}', [\App\Http\Controllers\Api\RestaurantApiController::class, 'destroy']);
