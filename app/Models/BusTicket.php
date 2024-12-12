<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusTicket extends Model
{
    // A bus ticket belongs to a user (many-to-one relationship)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A bus ticket belongs to a bus (many-to-one relationship)
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    // A bus ticket belongs to a festival (many-to-one relationship)
    // Used to track how many signups there are for a festival
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }
}
