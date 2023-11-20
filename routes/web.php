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

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/restaurants', [\App\Http\Controllers\RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}', [\App\Http\Controllers\RestaurantController::class, 'show'])->name('restaurants.show');
Route::get('/register', [\App\Http\Controllers\WelcomeController::class, 'welcome'])->name('register');
Route::get('/login', [\App\Http\Controllers\WelcomeController::class, 'welcome'])->name('login');
