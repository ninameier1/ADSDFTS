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
    // Nullable because a bus is only attached to a ticket once 35 bus tickets to a specific festival are sold
    public function bus()
    {
        return $this->belongsTo(Bus::class)->nullable();
    }
    // A bus ticket belongs to a festival (many-to-one relationship)
    // Used to track how many bus tickets are sold for a specific festival
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }
}
