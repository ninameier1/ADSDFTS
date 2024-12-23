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
    // Used to automatically schedule a bus if more than 35 tickets have been sold
    public function busTickets()
    {
        return $this->hasMany(BusTicket::class);
    }
}

