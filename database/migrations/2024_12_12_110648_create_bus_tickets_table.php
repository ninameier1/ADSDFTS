<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bustickets', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incremented
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the users table (a ticket belongs to a user)
            $table->foreignId('bus_id')->constrained()->onDelete('cascade'); // Link to the buses table (a ticket belongs to a bus)
            $table->foreignId('festival_id')->constrained()->onDelete('cascade'); // Link to the festivals table (a ticket belongs to a festival)
            $table->integer('seat_number'); // Seat number (from 1 to 35)
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_tickets');
    }
};
