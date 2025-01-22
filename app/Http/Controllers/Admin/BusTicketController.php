<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusTicket;
use App\Models\Festival;
use App\Models\User;
use Illuminate\Http\Request;

class BusTicketController extends Controller
{
    // Display a list of all bus tickets
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->get('search');

        // Fetch bustickets with eager loading, including the user (customer), bus, and festival relationships
        $bustickets = BusTicket::with(['bus', 'festival', 'user']) // Eager load user relationship
        ->when($search, function ($query, $search)
        {
            // Filter by customer name, bus number, or festival name
            return $query->whereHas('user', function ($query) use ($search)
            {
                $query->where('first_name', 'like', "%{$search}%"); // Search by customer name
                $query->where('last_name', 'like', "%{$search}%");
            })
                ->orWhereHas('bus', function ($query) use ($search)
                {
                    $query->where('bus_number', 'like', "%{$search}%"); // Search by bus number
                })
                ->orWhereHas('festival', function ($query) use ($search)
                {
                    $query->where('name', 'like', "%{$search}%"); // Search by festival name
                });
        })
            ->get();

        // Return the view with the bustickets and the search query
        return view('admin.bustickets.index', compact('bustickets', 'search'));
    }

    // Show details of a specific ticket
    public function show(BusTicket $busticket)
    {
        // Return the 'bustickets.show' view with the busticket data
        return view('admin.bustickets.show', compact('busticket'));
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

    // Remove a busticket
    public function destroy(BusTicket $busticket)
    {
        // Delete the specified busticket
        $busticket->delete();

        // Redirect back to the bustickets list with a success message
        return redirect()->route('admin.bustickets.index')->with('success', 'Ticket canceled successfully!');
    }
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
//        return view('admin.bustickets.edit', compact('busticket', 'buses', 'festival'));
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
