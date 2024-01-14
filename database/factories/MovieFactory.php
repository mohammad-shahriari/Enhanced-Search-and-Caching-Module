<?php

namespace Database\Factories;

use App\Models\Genre;
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

        $genre = Genre::query()->inRandomOrder()->first();

        return [
            'title' => $this->faker->title,
            'year' => $this->faker->year,
            'rank' => $this->faker->randomFloat(1, 0, 10),
            'description' => $this->faker->text,
            'genre_id' => $genre->id
        ];
    }
}
