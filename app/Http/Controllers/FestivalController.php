<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;

class FestivalController extends Controller
{
    // Display a list of festivals with bus and ticket counts
    public function index()
    {
        // Fetch all festivals along with counts of buses and tickets associated with each festival
        $festivals = Festival::withCount(['buses', 'bustickets'])->get();

        // Return the 'festivals.index' view, passing the festivals data to the view
        return view('festivals.index', compact('festivals'));
    }

    // Show the form to create a new festival (manual creation by admin)
    public function create()
    {
        // Return the 'festivals.create' view where the admin can create a new festival
        return view('festivals.create');
    }

    // Store a new festival (manual creation by admin)
    public function store(Request $request)
    {
        // Validate the incoming request data to ensure proper input
        $request->validate([
            'name' => 'required|string|unique:festivals', // Festival name must be unique
            'date' => 'required|date', // Festival date must be a valid date
            'location' => 'required|string', // Festival location must be a string
            'description' => 'required|string', // Description must be provided
            'genre' => 'nullable|string', // Genre is optional
        ]);

        // Create the festival in the database using mass assignment
        Festival::create($request->only(['name', 'date', 'location', 'description', 'genre']));

        // Redirect the admin back to the festivals index page with a success message
        return redirect()->route('festivals.index')->with('success', 'Festival created successfully!');
    }

    // Show a specific festival with bus and ticket counts
    public function show($id)
    {
        // Fetch the specific festival with counts of buses and tickets associated with it
        $festival = Festival::withCount('buses', 'bustickets')->findOrFail($id);

        // Return the 'festivals.index' view, passing the festival data to the view
        return view('festivals.index', compact('festival'));
    }

    // Show the form for editing the specified festival
    public function edit(Festival $festival)
    {
        // Return the 'festivals.edit' view where the admin can edit the festival details
        return view('festivals.edit', compact('festival'));
    }

    // Update the festival after form submission
    public function update(Request $request, Festival $festival)
    {
        // Validate the incoming request data to ensure proper input
        $request->validate([
            'name' => 'required|string|unique:festivals,name,' . $festival->id, // Ensure the festival name is unique except for the current festival
            'date' => 'required|date', // Festival date must be a valid date
            'location' => 'required|string', // Festival location must be a string
            'description' => 'required|string', // Description must be provided
            'genre' => 'nullable|string', // Genre is optional
        ]);

        // Update the festival in the database using mass assignment
        $festival->update($request->only(['name', 'date', 'location', 'description', 'genre']));

        // Redirect the admin back to the festivals index page with a success message
        return redirect()->route('festivals.index')->with('success', 'Festival updated successfully!');
    }

    // Remove a festival (delete the festival from the database)
    public function destroy(Festival $festival)
    {
        // Delete the festival from the database
        $festival->delete();

        // Redirect the admin back to the festivals index page with a success message
        return redirect()->route('festivals.index')->with('success', 'Festival deleted successfully!');
    }
}
