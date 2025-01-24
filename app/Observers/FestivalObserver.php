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
        // Define the starting points
        $startingPoints = ['Almere', 'Amsterdam', 'Utrecht'];

        // Automatically create a reserve bus for each starting point
        foreach ($startingPoints as $startingPoint) {
            Bus::create([
                'bus_number' => 'Reserve-' . uniqid(), // Automatically create a unique bus number
                'capacity' => 35, // Set the capacity to 35 seats
                'festival_id' => $festival->id, // Link the new bus to the festival
                'starting_point' => $startingPoint, // Assign the starting point
                'status' => 'reserve', // Set the new bus status to 'reserve'
            ]);
        }
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
