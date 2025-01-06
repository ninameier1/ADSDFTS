<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusTicket;
use App\Models\Festival;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusTicketController extends Controller
{
    // Display a list of all bus tickets (for admin)
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->get('search');

        // Fetch bustickets with eager loading, including the user (customer), bus, and festival relationships
        $bustickets = BusTicket::with(['bus', 'festival', 'user']) // Eager load user relationship
        ->when($search, function ($query, $search) {
            // Filter by customer name, bus number, or festival name
            return $query->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%"); // Search by user name
            })
                ->orWhereHas('bus', function ($query) use ($search) {
                    $query->where('bus_number', 'like', "%{$search}%"); // Search by bus number
                })
                ->orWhereHas('festival', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%"); // Search by festival name
                });
        })
            ->get();

        // Return the view with the bustickets and the search query
        return view('bustickets.index', compact('bustickets', 'search'));
    }

    // Show the form for booking a busticket (customer action)
    public function create()
    {
        // Fetch all festivals with their associated buses
        $festivals = Festival::with('buses')->get();
        $users = User::all(); // Fetch all users
        $buses = Bus::all();

        // Return the 'bustickets.create' view, passing the festivals and buses data
        return view('bustickets.create', compact('festivals', 'users', 'buses'));
    }

    // Store a new busticket (customer action)
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the user exists
            'festival_id' => 'required|exists:festivals,id', // Ensure the festival exists
        ]);

        // Find the selected festival
        $festival = Festival::findOrFail($request->festival_id);

        // Find the first available bus with 'reserve' status for the selected festival
        $bus = $festival->buses()->where('status', 'reserve')->first();

        if (!$bus) // Error
        {
            return redirect()->route('bustickets.index')->with('error', 'No buses available for this festival.');
        }

        // Create a new bus ticket
        BusTicket::create([
            'user_id' => $request->user_id, // Link to the customer
            'bus_id' => $bus->id, // Link to the bus with 'reserve' status
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

//    // Show the form for editing an existing busticket (admin action)
//    public function edit(BusTicket $busticket)
//    {
//        // Fetch the festival associated with the current bus ticket
//        $festival = $busticket->festival;
//
//        // Fetch only buses associated with this festival
//        $buses = $festival->buses;
//
//        // Return the 'bustickets.edit' view, passing the busticket, buses, and festival data
//        return view('bustickets.edit', compact('busticket', 'buses', 'festival'));
//    }


//    // Update a busticket manually (admin action)
//    public function update(Request $request, BusTicket $busTicket)
//    {
//        // Validate the incoming request data
//        $request->validate([
//            'seat_number' => 'required|integer|min:1|max:35', // Validate seat number
//            'bus_id' => 'required|exists:buses,id', // Validate bus_id exists in the buses table
//        ]);
//
//        // Update the busticket details, including the bus_id
//        $busTicket->update([
//            'seat_number' => $request->seat_number, // Update the seat number
//            'bus_id' => $request->bus_id, // Update the bus id
//        ]);
//
//        // Redirect back to the bustickets list with a success message
//        return redirect()->route('bustickets.index')->with('success', 'Ticket updated successfully!');
//    }


    // Remove a busticket (admin action)
    public function destroy(BusTicket $busticket)
    {
        // Delete the specified busticket
        $busticket->delete();

        // Redirect back to the bustickets list with a success message
        return redirect()->route('bustickets.index')->with('success', 'Ticket canceled successfully!');
    }
}
