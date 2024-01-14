<?php

namespace Database\Factories;

use App\Models\Crew;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieCrewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        $movie = Movie::query()->inRandomOrder()->first();
        $crew = Crew::query()->inRandomOrder()->first();

        return [
            'movie_id' => $movie->id,
            'crew_id' => $crew->id,
        ];
    }
}
