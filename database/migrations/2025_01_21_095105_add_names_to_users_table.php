<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id'); // Add first_name column
            $table->string('last_name')->after('first_name'); // Add last_name column
            $table->dropColumn('name'); // Remove the name column
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id'); // Re-add the name column
            $table->dropColumn(['first_name', 'last_name']); // Remove first_name and last_name columns
        });
    }
};
