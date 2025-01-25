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

        // Group the tickets by festival
        $busticketsGrouped = $bustickets->groupBy(fn($ticket) => $ticket->festival ? $ticket->festival->name : 'No Festival');

        // Return the view with the grouped tickets
        return view('bustickets.index', compact('busticketsGrouped', 'search'));
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

        // Define the trip cost (1000 points per trip)
        $tripCost = 1000; // Adjust this if needed, or calculate based on quantity if passed

        // Pass the trip details, festival, and trip cost to the view
        return view('bustickets.create', compact('from', 'festival', 'tripCost'));
    }
//    public function store(Request $request)
//    {
//        // Validate the incoming request data
//        $validatedData = $request->validate([
//            'first_name' => 'required|string',
//            'last_name' => 'required|string',
//            'email' => 'required|email',
//            'from' => 'required|string',
//            'festival_id' => 'required|exists:festivals,id',
//            'quantity' => 'required|integer|min:1|max:35',
//            'points' => 'nullable|integer|min:0',
//            'pay_with_points' => 'nullable|boolean',
//        ]);
//
//        $festival = Festival::findOrFail($validatedData['festival_id']);
//
//        // Find the first available bus with 'reserve' status and matching starting point
//        $bus = $festival->buses()
//            ->where('starting_point', $validatedData['from'])
//            ->where('status', 'reserve')
//            ->first();
//
//        if (!$bus) {
//            return redirect()->route('bustickets.index')->with('error', 'No buses available for this festival.');
//        }
//
//        // Check if there are enough seats available on the bus
//        $availableSeats = 35 - BusTicket::where('bus_id', $bus->id)->count();
//        if ($validatedData['quantity'] > $availableSeats) {
//            return redirect()->back()->with('error', 'Not enough seats available on this bus.');
//        }
//
//        // Calculate the total cost of the tickets
//        $totalCost = $validatedData['quantity'] * 1000; // 1000 points per ticket
//
//        // Get the current logged-in user
//        $user = auth()->user();
//
//        // Check if the user is paying with points
//        if (isset($validatedData['pay_with_points']) && $validatedData['pay_with_points']) {
//            if ($user->points >= $totalCost) {
//                $user->points -= $totalCost;
//                $user->save(); // Save the updated user points
//            } else {
//                return redirect()->back()->with('error', "You don't have enough points to complete the booking.");
//            }
//        }
//
//        // Generate tickets based on the quantity
//        for ($i = 0; $i < $validatedData['quantity']; $i++) {
//            $maxSeatNumber = BusTicket::where('bus_id', $bus->id)->max('seat_number');
//            $seatNumber = $maxSeatNumber ? $maxSeatNumber + 1 : 1;
//
//            BusTicket::create([
//                'user_id' => $user->id,
//                'bus_id' => $bus->id,
//                'festival_id' => $festival->id,
//                'seat_number' => $seatNumber,
//                'starting_point' => $validatedData['from'],
//            ]);
//        }
//
//        // Return the success message with the updated points
//        return redirect()->route('bustickets.index')->with('success', "{$validatedData['quantity']} ticket(s) booked successfully!")->with('updated_points', $user->points);
//    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'from' => 'required|string|max:255',
            'festival_id' => 'required|exists:festivals,id',
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1|max:35',
            'paymentOption' => 'required|in:cash,points',
        ]);

        $user = auth()->user();
        $tripCost = 1000; // Example cost in points per ticket
        $totalCost = $tripCost * $request->quantity;        // Fetch the festival based on the ID
        $festival = Festival::findOrFail($validatedData['festival_id']);

        // Check payment option
        if ($request->paymentOption === 'points') {
            if ($user->points < $totalCost) {
                return redirect()->back()->withErrors(['insufficient_points' => 'You do not have enough points for this booking.']);
            }

            // Deduct points
            $user->points -= $totalCost;
            $user->save();
        }

        // Find the first available bus with 'reserve' status and matching starting point
        $bus = $festival->buses()
            ->where('starting_point', $validatedData['from'])
            ->where('status', 'reserve')
            ->first();

        if (!$bus)
        {
            return redirect()->route('bustickets.index')->with('error', 'No buses available for this festival.');
        }

        // Check if there are enough seats available on the bus
        $availableSeats = 35 - $bus->bustickets->count();
        if ($validatedData['quantity'] > $availableSeats)
        {
            return redirect()->back()->with('error', 'Not enough seats available on this bus.');
        }

        // Generate tickets based on the quantity
        for ($i = 0; $i < $validatedData['quantity']; $i++)
        {
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
