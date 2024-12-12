<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    // A bus can have many bus tickets (one-to-many relationship)
    // Up to 35 tickets can be sold for one bus
    public function busTickets()
    {
        return $this->hasMany(BusTicket::class);
    }

    // A bus belongs to one festival (many-to-one relationship)
    // This is also the destination
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }
}


