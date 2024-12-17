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
        Schema::create('users', function (Blueprint $table)
        {
            $table->id(); // Primary key, auto-incremented
            $table->string('name'); // Username
            $table->string('email')->unique(); // Email address, must be unique
            $table->string('password'); // User's password
            $table->enum('role', ['admin', 'customer']); // Role of the user (admin or customer)
            $table->integer('points')->default(0); // Points system, default is 0
            $table->rememberToken(); // Used for the 'remember me' function
            $table->timestamps(); // Created_at and updated_at timestamps
        });

        Schema::create('password_reset_tokens', function (Blueprint $table)
        {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table)
        {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check if the 'bustickets' table exists before attempting to drop the foreign key
        if (Schema::hasTable('bustickets'))
        {
            Schema::table('bustickets', function (Blueprint $table) {
                $table->dropForeign(['user_id']); // Adjust the foreign key column name if needed
            });
        }

        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
