<?php

use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TableController;
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
Route::get('/', [\App\Http\Controllers\RestaurantController::class, 'index'])->name('welcome');

// Restaurant routes
Route::get('/restaurants', [\App\Http\Controllers\RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}', [\App\Http\Controllers\RestaurantController::class, 'show'])->name('restaurants.show');


// MenuItem routes
Route::get('/restaurants/{id}/menuItem', [\App\Http\Controllers\MenuItemController::class, 'index'])->name('menuItems.index');
Route::get('/menuItem/{id}', [\App\Http\Controllers\MenuItemController::class, 'show'])->name('menuItems.show');

// Table routes
Route::get('/restaurants/{id}/table', [\App\Http\Controllers\TableController::class, 'index'])->name('tables.index');
Route::get('/tables/{id}', [\App\Http\Controllers\TableController::class, 'show'])->name('tables.show');

require __DIR__ . '/auth.php';

Route::prefix('home')->name('home.')->middleware('auth')->group(function () {
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('menuItems', MenuItemController::class);
    Route::resource('tables', TableController::class);
});

// Admin User routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is.admin'])->group(function () {
    Route::resource('orders', OrdersController::class);
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
