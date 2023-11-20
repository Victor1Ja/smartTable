<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//* Public routes

// Welcome route
Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');

// Restaurant routes
Route::get('/restaurants', [\App\Http\Controllers\RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}', [\App\Http\Controllers\RestaurantController::class, 'show'])->name('restaurants.show');

// MenuItem routes
Route::get('/restaurants/{id}/menuItem', [\App\Http\Controllers\MenuItemController::class, 'index'])->name('menuItems.index');
Route::get('/menuItem/{id}', [\App\Http\Controllers\MenuItemController::class, 'show'])->name('menuItems.show');

// Table routes
Route::get('/restaurants/{id}/table', [\App\Http\Controllers\TableController::class, 'index'])->name('tables.index');
Route::get('/table/{id}', [\App\Http\Controllers\TableController::class, 'show'])->name('tables.show');

// Auth routes
Route::get('/register', [\App\Http\Controllers\WelcomeController::class, 'welcome'])->name('register');
Route::get('/login', [\App\Http\Controllers\WelcomeController::class, 'welcome'])->name('login');
