<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $restaurants = Restaurant::all();
        return view('welcome', compact('restaurants'));
    }
}
