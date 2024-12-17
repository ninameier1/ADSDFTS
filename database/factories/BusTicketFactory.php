<?php

namespace Database\Factories;

use App\Models\BusTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusTicket>
 */
class BusTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        protected $model = BusTicket::class;
    public function definition(): array
    {
        return [
            'seat_number' => fake()->unique()->numberBetween(1, 1000),
        ];
    }
}
