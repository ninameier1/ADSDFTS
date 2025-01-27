<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Festival;
use App\Models\Bus;
use App\Models\BusTicket;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $users = \App\Models\User::factory(10)->create();

        // Create a specific admin user just for me
        User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        // Test user for dusk
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
            'role' => 'customer',
        ]);

        // Create festivals
        $festivals = \App\Models\Festival::factory(6)->create();

        // Create buses for each festival
        foreach ($festivals as $festival)
        {
            // Create multiple buses for each festival
            $buses = \App\Models\Bus::factory(3)->create([
                'festival_id' => $festival->id, // Pass the festival_id like a hot potato
            ]);

            // Looploop through each bus and create bus tickets for each bus
            foreach ($buses as $bus)
            {
                // Create 35 bus tickets for each bus
                BusTicket::factory(35)->create([
                    'bus_id' => $bus->id, // Associate the ticket with the bus
                    'festival_id' => $festival->id, // Festival associated with the bus
                    'user_id' => $users->random()->id, // Assign random user to the ticket
                ]);
            }
        }
    }
}
