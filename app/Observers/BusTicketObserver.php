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
        if ($bus->status === 'reserve' && $bus->bustickets->count() >= 35)
        {
            // Update the bus status to 'scheduled' once 35 tickets are sold
            $bus->status = 'scheduled';
            $bus->save();

            // Check if there is already a reserve bus for the festival
            $existingReserveBus = Bus::where('festival_id', $bus->festival_id)
                ->where('status', 'reserve')
                ->first();

            // If no reserve bus exists, create a new one
            if (!$existingReserveBus) {
                Bus::create([
                    'bus_number' => 'Reserve-' . uniqid(), // Automatically create a unique bus number
                    'capacity' => 35, // Set the capacity to 35 seats
                    'festival_id' => $bus->festival_id, // Link the new bus to the same festival
                    'status' => 'reserve', // Set the new bus status to 'reserve'
                ]);
            }
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
