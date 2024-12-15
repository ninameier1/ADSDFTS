<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Festival;
use Illuminate\Http\Request;

class BusController extends Controller
{
    // Display a list of buses with ticket counts
    public function index()
    {
        // Fetch all buses along with the count of tickets associated with each bus
        $buses = Bus::withCount('tickets')->get();

        // Return the 'buses.index' view, passing the buses data to the view
        return view('buses.index', compact('buses'));
    }

    // Show the form to create a new bus (manual creation by admin)
    public function create()
    {
        // Fetch all festivals to allow the admin to choose one for the new bus
        $festivals = Festival::all();  // Admin selects the festival the bus is associated with

        // Return the 'buses.create' view, passing the festivals data to the view
        return view('buses.create', compact('festivals'));
    }

    // Create a new bus (manual creation by admin)
    public function store(Request $request)
    {
        // Validate the incoming request data to ensure proper input
        $request->validate([
            'bus_number' => 'required|string|unique:buses',
            'capacity' => 'required|integer',
            'festival_id' => 'required|exists:festivals,id',
            'starting_point' => 'nullable|string',
            'departure_time' => 'nullable|date',
            'arrival_time' => 'nullable|date',
        ]);

        // Create the bus using all validated fields that match the $fillable array
        Bus::create($request->only(array_keys($request->validated())));

        // Redirect the admin back to the bus index page with a success message
        return redirect()->route('buses.index')->with('success', 'Bus created successfully!');
    }

    // Show a specific bus
    public function show(Bus $bus)
    {
        return view('buses.show', compact('bus')); // Return the 'buses.show' view with the bus data
    }

    // Show the form for editing the specified bus
    public function edit(Bus $bus)
    {
        // Fetch all festivals to allow the admin to re-select a festival if needed
        $festivals = Festival::all();  // Admin may change the festival the bus is associated with

        // Return the 'buses.edit' view, passing the bus and festivals data to the view
        return view('buses.edit', compact('bus', 'festivals'));
    }

    // Update the bus after form submission
    public function update(Request $request, Bus $bus)
    {
        // Validate the incoming request data to ensure proper input
        $request->validate([
            'bus_number' => 'required|string|unique:buses,bus_number,' . $bus->id, // Ensure the bus number is unique, except for the current bus being updated
            'capacity' => 'required|integer', // Validate that the capacity is an integer
            'festival_id' => 'required|exists:festivals,id', // Ensure festival_id exists in the festivals table
            'starting_point' => 'nullable|string', // Starting point is optional
            'departure_time' => 'nullable|date', // Departure time is optional
            'arrival_time' => 'nullable|date', // Arrival time is optional
        ]);

        // Update the bus data using mass assignment with only the necessary fields
        $bus->update($request->only(['bus_number', 'capacity', 'starting_point', 'departure_time', 'arrival_time', 'festival_id']));

        // Redirect the admin back to the bus index page with a success message
        return redirect()->route('buses.index')->with('success', 'Bus updated successfully!');
    }

    // Remove a bus (delete the bus from the database)
    public function destroy(Bus $bus)
    {
        // Delete the bus from the database
        $bus->delete();

        // Redirect the admin back to the bus index page with a success message
        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully!');
    }
}
