<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Language;
use App\Enums\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(asText: true),
            'description' => $this->faker->paragraph,
            'rating' => $this->faker->randomElement(Rating::values()),
            'language' => $this->faker->randomElement(Language::values()),
        ];
    }
}
