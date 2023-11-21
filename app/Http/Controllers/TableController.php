<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use App\Models\Table;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    // Index method to list all tables
    public function index($id)
    {
        $from = [255, 0, 0];
        $to = [0, 0, 255];
        $tables = Table::all()->where('restaurantID', $id);
        $number = 0;
        foreach ($tables as $table) {
            $table->svgQr = QrCode::size(256)
                ->style('dot')
                ->eye('circle')
                ->margin(1)
                ->generate(
                    route('tables.show', ['id' => $table->id])
                );
            $table->number = $number + 1;
            $number = $number + 1;
        }
        return view('home.tables.index', compact('tables'));
    }
    public function downloadQr($id)
    {
        function down($id)
        {
            echo QrCode::size(256)
                ->style('dot')
                ->eye('circle')
                ->margin(1)
                ->format('png')
                ->generate(
                    route('tables.show', ['id' => $id])
                );
        }
        return response()->streamDownload(
            down($id),
            'qr-code.png',
            [
                'Content-Type' => 'image/png',
            ]
        );
    }

    // Show method to display a specific table
    public function show($id)
    {
        $table = Table::all()->find($id)->loadMissing('restaurant');
        $menuItems = MenuItem::all()->where('restaurantID', $table->restaurantID);

        return view('home.tables.show', compact('table', 'menuItems'));
    }

    // Create method to show the create form
    public function create()
    {
        return view('tables.create');
    }

    // Store method to save a new table
    public function store(Request $request)
    {
        // Validation and store logic here
    }

    // Edit method to show the edit form
    public function edit($id)
    {
        $table = Table::find($id);
        return view('tables.edit', compact('table'));
    }

    // Update method to update a specific table
    public function update(Request $request, $id)
    {
        // Validation and update logic here
    }

    // Delete method to remove a specific table
    public function destroy($id)
    {
        // Delete logic here
    }
}
