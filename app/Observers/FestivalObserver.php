<?php

namespace App\Observers;

use App\Models\Festival;
use App\Models\Bus;

class FestivalObserver
{
    /**
     * Handle the Festival "created" event.
     */
    public function created(Festival $festival)
    {
        // Automatically create a reserve bus for the newly created festival
        Bus::create([
            'bus_number' => 'Reserve-' . uniqid(), // Automatically create a unique bus number
            'capacity' => 35, // Set the capacity to 35 seats
            'festival_id' => $festival->id, // Link the new bus to the festival
            'status' => 'reserve', // Set the new bus status to 'reserve'
        ]);
    }

    /**
     * Handle the Festival "updated" event.
     */
    public function updated(Festival $festival): void
    {
        //
    }

    /**
     * Handle the Festival "deleted" event.
     */
    public function deleted(Festival $festival): void
    {
        //
    }

    /**
     * Handle the Festival "restored" event.
     */
    public function restored(Festival $festival): void
    {
        //
    }

    /**
     * Handle the Festival "force deleted" event.
     */
    public function forceDeleted(Festival $festival): void
    {
        //
    }
}
