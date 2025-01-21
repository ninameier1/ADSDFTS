<?php

namespace App\Http\Controllers;

use App\Models\BusTicket;
use App\Models\Festival;
use App\Models\User;
use Illuminate\Http\Request;

class BusTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // Show the form for booking a busticket (customer action)
    public function create()
    {
        // Fetch all festivals
        $festivals = Festival::all();

        // Return the 'bustickets.create' view, passing the festivals, users, and buses data
        return view('bustickets.create', compact('festivals'));
    }

    // Store a new busticket (customer action)
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'festival_id' => 'required|exists:festivals,id', // Ensure the festival exists
        ]);

        // Find the selected festival
        $festival = Festival::findOrFail($validatedData['festival_id']);

        // Find the first available bus with 'reserve' status for the selected festival
        $bus = $festival->buses()->where('status', 'reserve')->first();

        if (!$bus) // Error if there is no bus
        {
            return redirect()->route('bustickets.index')->with('error', 'No buses available for this festival.');
        }

        // Find the highest seat number already booked for this bus
        $maxSeatNumber = BusTicket::where('bus_id', $bus->id)->max('seat_number');

        // Generate the next available seat number (increment by 1)
        $seatNumber = $maxSeatNumber ? $maxSeatNumber + 1 : 1; // Start from 1 if no seat has been booked yet

        // Create a new bus ticket with the generated seat number and the associated festival_id
        BusTicket::create([
            'user_id' => auth()->user()->id, // Automatically filled with the logged-in user's ID
            'bus_id' => $bus->id, // Link to the bus with 'reserve' status
            'festival_id' => $festival->id, // Explicitly set the festival_id
            'seat_number' => $seatNumber, // Automatically generated seat number
        ]);

        // Redirect back to the bus tickets list with a success message
        return redirect()->route('bustickets.index')->with('success', 'Ticket booked successfully!');
    }

    // Show details of a specific ticket
    public function show(BusTicket $busticket)
    {
        // Return the 'bustickets.show' view with the busticket data
        return view('bustickets.show', compact('busticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
