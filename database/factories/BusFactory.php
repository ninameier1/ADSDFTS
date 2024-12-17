<?php

namespace Database\Factories;

use App\Models\Bus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Bus::class;
    public function definition(): array
    {
        return [
            'bus_number' => 'Bus-' . uniqid(), // Bus counter
            'status' => 'scheduled', // Set the default status to 'scheduled'
            'capacity' => 35, // Duh
            'starting_point' => fake()->city(), // Nullable starting point, optional
            'departure_time' => fake()->dateTimeBetween('now', '+5 days'), // Nullable departure time, optional yay
            'arrival_time' => fake()->dateTimeBetween('+5 days', '+10 days'), // Nullable arrival time, optional
        ];
    }
}
