<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Crew;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieCrew;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Genre::factory(10)->create();
        Movie::factory(10)->create();
        Crew::factory(10)->create();
        MovieCrew::factory(10)->create();

    }
}
