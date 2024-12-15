<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusTicket;
use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusTicketController extends Controller
{
    // Display a list of all bus tickets (for admin)
    public function index()
    {
        // Fetch all bus tickets
        $tickets = BusTicket::with(['bus', 'festival'])->get(); // Eager loading bus and festival data

        // Return the 'tickets.index' view with the tickets data
        return view('tickets.index', compact('tickets'));
    }

    // Show the form for booking a ticket (customer action)
    public function create()
    {
        // Fetch all festivals with their associated buses
        $festivals = Festival::with('buses')->get();

        // Return the 'tickets.create' view, passing the festivals and buses data
        return view('tickets.create', compact('festivals'));
    }

    // Store a new ticket (customer action)
    public function store(Request $request)
    {
        // Use a database transaction to make sure all actions succeed or fail together
        DB::transaction(function() use ($request) {
            // Check if the request data is valid
            $request->validate([
                'customer_name' => 'required|string|max:255', // Customer name is required and must be text
                'bus_id' => 'required|exists:buses,id', // Bus ID is required and must exist in the buses table
            ]);

            // Find the bus the customer wants to book
            $bus = Bus::findOrFail($request->bus_id);

            // Check if there is space left on the bus
            $bookedTickets = BusTicket::where('bus_id', $bus->id)->count();
            if ($bookedTickets >= $bus->capacity) {
                throw new \Exception('This bus is fully booked.'); // Stop if the bus is full
            }

            // Create a new ticket for the customer
            BusTicket::create([
                'customer_name' => $request->customer_name, // Save the customer's name
                'bus_id' => $request->bus_id, // Link the ticket to the chosen bus
            ]);

            // Find the festival connected to the bus
            $festivalId = $bus->festival_id;

            // Count how many tickets have been sold for this festival
            $totalTicketsForFestival = BusTicket::whereHas('bus', function ($query) use ($festivalId) {
                $query->where('festival_id', $festivalId); // Look at all buses for the same festival
            })->count();

            // If the total tickets sold is a multiple of 35, add a new bus
            if ($totalTicketsForFestival % 35 === 0) {
                Bus::create([
                    'bus_number' => 'Auto-' . uniqid(), // Automatically create a unique bus number
                    'capacity' => 35, // Set the capacity to 35 seats
                    'festival_id' => $festivalId, // Link the new bus to the same festival
                ]);
            }
        });

        // Redirect the user back to the tickets list with a success message
        return redirect()->route('tickets.index')->with('success', 'Ticket booked successfully!');
    }

    // Show details of a specific ticket
    public function show(BusTicket $ticket)
    {
        // Return the 'tickets.show' view with the ticket data
        return view('tickets.show', compact('ticket'));
    }

    // Update a ticket manually (admin action)
    public function update(Request $request, BusTicket $ticket)
    {
        // Validate the incoming request data
        $request->validate([
            'seat_number' => 'required|integer|min:1|max:35', // Validate seat number
        ]);

        // Update the ticket details
        $ticket->update([
            'seat_number' => $request->seat_number, // Update the seat number
        ]);

        // Redirect back to the tickets list with a success message
        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully!');
    }

    // Remove a ticket (admin action)
    public function destroy(BusTicket $ticket)
    {
        // Delete the specified ticket
        $ticket->delete();

        // Redirect back to the tickets list with a success message
        return redirect()->route('tickets.index')->with('success', 'Ticket canceled successfully!');
    }
}
