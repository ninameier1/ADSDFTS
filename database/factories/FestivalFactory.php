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
        // It was SO UGLY when I used the inbuilt random words generator so I made a list of words so the festivals actually have decent names
        $nouns = [
            'Banana',
            'Sock',
            'Cat',
            'Guitar',
            'Mountain',
            'River',
            'Festival',
            'Music',
            'Star',
            'Cloud',
            'Tree',
            'Ocean',
            'Sun',
            'Moon',
            'Flower',
            'Dream',
            'Sky',
            'Fire',
            'Rock',
            'Wind',
            'Rain',
            'Light',
            'Shadow',
            'Harmony',
            'Echo',
            'Dance',
            'Spirit',
            'Wave',
            'Drum',
            'Journey',
            'Forest',
            'Heart',
            'Sound',
            'Energy',
            'Magic',
            'Wonder',
            'Freedom',
        ];

        // Get all image paths from the public/storage/images directory
        $imageFiles = glob(public_path('storage/images/*'));

        return [
            'name' => implode(' ', fake()->randomElements($nouns, 3)), // Combine 3 random nouns to make a super cool festival name
            'location' => fake()->city(), // Example: "Amsterdam" :)
            'date' => fake()->dateTimeBetween('+1 week', '+1 year'), // Random future date
            'description' => fake()->paragraph(), // Example: "A music event..." or whatever admin wants to write
            'genre' => fake()->randomElement(['Rock', 'Metal', 'Pop', 'Jazz', 'EDM', null]), // Random genre or null if admin is too lazy
            'image' => $imageFiles ? str_replace(public_path(), '', fake()->randomElement($imageFiles)) : null, // Random image from the ones already in library
        ];
    }
}
