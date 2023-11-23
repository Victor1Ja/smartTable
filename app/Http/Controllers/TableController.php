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
        $restaurantId = $id;
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
        return view('home.tables.index', compact('tables', 'restaurantId'));
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
        $table->ray();

        $menuItems = MenuItem::all()->where('restaurantID', $table->restaurantID);

        return view('home.tables.show', compact('table', 'menuItems'));
    }

    // Create method to show the create form
    public function create(Request $request)
    {
        $restaurantId = $request->restaurantID;
        return view('home.tables.form', compact('restaurantId'));
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
            'restaurantID' => 'required|exists:restaurants,id', // Ensure the restaurant exists
            'number' => 'required|integer',
            'location' => 'nullable|string',
        ]);
        $table = Table::create($request->all());
        return redirect()->route('welcome')->with('success', 'Restaurant table created successfully.');
    }
    // Edit method to show the edit form
    public function edit($id)
    {
        $table = Table::find($id);
        return view('home.tables.form', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'number' => 'required|integer',
            'location' => 'nullable|string',
        ]);

        $table->update($request->all());

        return redirect()->route('tables.index')->with('success', 'Restaurant table updated successfully.');
    }
    // Delete method to remove a specific table
    public function destroy($id)
    {
        // Delete logic here
    }
}
