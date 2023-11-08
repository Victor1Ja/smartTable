<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    // Index method to list all tables
    public function index()
    {
        $tables = Table::all();
        return view('tables.index', compact('tables'));
    }

    // Show method to display a specific table
    public function show($id)
    {
        $table = Table::find($id);
        return view('tables.show', compact('table'));
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
