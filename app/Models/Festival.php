<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Festival extends Model
{
    use HasFactory;
    // Fill it all at once
    protected $fillable = [
        'name',
        'location',
        'image',
        'date',
        'description',
        'genre',
    ];

    // Something with carbon that otherwise gives error
    protected $casts = [
        'date' => 'datetime',
    ];

    // A festival can have many buses (many-to-one relationship)
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }

    // A festival can have many bus tickets (many-to-one relationship)
    public function busTickets()
    {
        return $this->hasMany(BusTicket::class);
    }

    // Count the number of sold tickets for the festival
    public function soldTicketsCount()
    {
        return $this->bustickets()->count(); // Used to count if more than 35 tickets have been sold
    }
}

