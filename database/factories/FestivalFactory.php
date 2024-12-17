<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Festival;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Festival>
 */
class FestivalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Festival::class;
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true), // Example: "Rock Festival" but it's just random gibberish :(
            'location' => fake()->city(), // Example: "Amsterdam" :)
            'date' => fake()->dateTimeBetween('+1 week', '+1 year'), // Random future date to look forward to
            'description' => fake()->paragraph(), // Example: "A music event..." or whatever admin wants to write
            'genre' => fake()->randomElement(['Rock', 'Metal', 'Pop', 'Jazz', 'EDM', null]), // Random genre or null if admin is too lazy
        ];
    }
}
