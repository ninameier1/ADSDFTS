<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Bus extends Model
{
    use HasFactory;
    // Fill it all up at once
    protected $fillable = [
        'bus_number',
        'capacity',
        'starting_point',
        'departure_time',
        'arrival_time',
        'festival_id',
    ];

    // A bus can have many bus tickets (one-to-many relationship)
    public function busTickets() // Up to 35 tickets can be sold for one bus
    {
        return $this->hasMany(BusTicket::class);
    }

    // A bus belongs to one festival (many-to-one relationship)
    public function festival() // This is also the destination
    {
        return $this->belongsTo(Festival::class);
    }

    // Count the number of tickets sold
    public function soldTicketsCount() // Used to count if more than 35 tickets have been sold
    {
        return $this->bustickets()->count();
    }
}
