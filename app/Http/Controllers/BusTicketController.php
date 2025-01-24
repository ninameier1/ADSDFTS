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
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $bustickets = Busticket::with(['user', 'bus', 'festival'])
            ->where('user_id', auth()->id()) // Filter by the logged-in user
            ->get();

        return view('bustickets.index', compact('bustickets', 'search'));
    }


    // Show the form for booking a busticket (customer action)
//    public function create()
//    {
//        // Fetch all festivals
//        $festivals = Festival::all();
//        $user = auth()->user(); // Get the authenticated user
//
//        // Return the 'bustickets.create' view, passing the festivals, users, and buses data
//        return view('bustickets.create', compact('festivals', 'user'));
//    }


// Show the ticket booking page with selected trip details
    public function create(Request $request)
    {
        // Retrieve 'from' and 'festival_id' from the query parameters
        $from = $request->get('from');
        $festivalId = $request->get('festival_id');

        // Fetch the festival based on the ID
        $festival = Festival::findOrFail($festivalId);

        // Pass the trip details and festival to the view
        return view('bustickets.create', compact('from', 'festival'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'from' => 'required|string',
            'festival_id' => 'required|exists:festivals,id',
            'quantity' => 'required|integer|min:1|max:35', // Add quantity validation
        ]);

        // Fetch the festival based on the ID
        $festival = Festival::findOrFail($validatedData['festival_id']);

        // Find the first available bus with 'reserve' status and matching starting point
        $bus = $festival->buses()
            ->where('starting_point', $validatedData['from'])
            ->where('status', 'reserve')
            ->first();

        if (!$bus) {
            return redirect()->route('bustickets.index')->with('error', 'No buses available for this festival.');
        }

        // Check if there are enough seats available on the bus
        $availableSeats = 35 - $bus->bustickets->count();
        if ($validatedData['quantity'] > $availableSeats) {
            return redirect()->back()->with('error', 'Not enough seats available on this bus.');
        }

        // Generate tickets based on the quantity
        for ($i = 0; $i < $validatedData['quantity']; $i++) {
            // Find the highest seat number already booked for this bus
            $maxSeatNumber = BusTicket::where('bus_id', $bus->id)->max('seat_number');

            // Generate the next available seat number
            $seatNumber = $maxSeatNumber ? $maxSeatNumber + 1 : 1;

            // Create a new bus ticket
            BusTicket::create([
                'user_id' => $request->user_id,
                'bus_id' => $bus->id,
                'festival_id' => $festival->id,
                'seat_number' => $seatNumber,
                'starting_point' => $validatedData['from'], // Save 'from' as 'starting_point'
            ]);
        }

        return redirect()->route('bustickets.index')->with('success', "{$validatedData['quantity']} ticket(s) booked successfully!");
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
