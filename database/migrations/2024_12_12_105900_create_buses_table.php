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
        Schema::create('buses', function (Blueprint $table)
        {
            $table->id(); // Primary key, auto-incremented
            $table->string('bus_number')->unique(); // Unique bus number, identifies the bus
            $table->enum('status', ['reserve', 'scheduled'])->default('reserve'); // Enum for bus status, default is 'reserve'
            $table->integer('capacity')->default(35); // Capacity of the bus, default is 35 seats
            $table->string('starting_point')->nullable(); // Nullable starting point (where the bus departs from)
            $table->datetime('departure_time')->nullable(); // Nullable departure time
            $table->datetime('arrival_time')->nullable(); // Nullable arrival time
            $table->foreignId('festival_id')->nullable()->constrained()->onDelete('set null'); // Link to the festival the bus is associated with (nullable)
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraint before dropping the buses table
        Schema::table('bustickets', function (Blueprint $table)
        {
            $table->dropForeign(['bus_id']); // Adjust the foreign key column name if needed
        });

        Schema::dropIfExists('buses');
    }
};
