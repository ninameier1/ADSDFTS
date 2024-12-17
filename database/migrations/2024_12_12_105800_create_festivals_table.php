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
        Schema::create('festivals', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incremented
            $table->string('name'); // Name of the festival
            $table->string('location'); // Location where the festival is held
            $table->date('date'); // Date of the festival
            $table->text('description'); // A description of the festival
            $table->string('genre')->nullable(); // Adding a genre column to filter festivals by music genre
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key constraint before dropping the festivals table
        Schema::table('bustickets', function (Blueprint $table)
        {
            $table->dropForeign(['festival_id']); // Adjust the foreign key column name if needed
        });

        Schema::dropIfExists('festivals');
    }
};
