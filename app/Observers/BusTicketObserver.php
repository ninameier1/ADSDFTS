<?php

namespace App\Observers;

use App\Models\BusTicket;
use App\Models\Festival;
use App\Models\Bus;

class BusTicketObserver
{
    /**
     * Handle the BusTicket "created" event.
     */
    public function created(BusTicket $busTicket)
    {
        // Get the bus associated with the ticket
        $bus = $busTicket->bus;

        // Check if the bus is a reserve bus and if it has 35 tickets sold
        if ($bus->status === 'reserve' && $bus->bustickets->count() >= 35) {
            // Update the bus status to 'scheduled' once 35 tickets are sold
            $bus->status = 'scheduled';
            $bus->save();

            // Check if there is already a reserve bus for the same festival and starting point
            $existingReserveBus = Bus::where('festival_id', $bus->festival_id)
                ->where('starting_point', $bus->starting_point) // Match the starting point
                ->where('status', 'reserve')
                ->first();

            // If no reserve bus exists for the starting point, create a new one
            if (!$existingReserveBus) {
                Bus::create([
                    'bus_number' => 'Reserve-' . uniqid(), // Automatically create a unique bus number
                    'capacity' => 35, // Set the capacity to 35 seats
                    'festival_id' => $bus->festival_id, // Link the new bus to the same festival
                    'starting_point' => $bus->starting_point, // Use the same starting point
                    'status' => 'reserve', // Set the new bus status to 'reserve'
                ]);
            }
        }
        // Points System Logic
        $user = $busTicket->user;

        if ($user)
        {
            // Define points per ticket
            $pointsPerTicket = 100;

            // Add points to the user's account
            $user->points += $pointsPerTicket;
            $user->save();
        }
    }



    /**
     * Handle the BusTicket "updated" event.
     */
    public function updated(BusTicket $busTicket): void
    {
        //
    }

    /**
     * Handle the BusTicket "deleted" event.
     */
    public function deleted(BusTicket $busTicket): void
    {
        //
    }

    /**
     * Handle the BusTicket "restored" event.
     */
    public function restored(BusTicket $busTicket): void
    {
        //
    }

    /**
     * Handle the BusTicket "force deleted" event.
     */
    public function forceDeleted(BusTicket $busTicket): void
    {
        //
    }
}
