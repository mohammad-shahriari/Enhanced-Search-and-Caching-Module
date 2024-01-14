<?php

namespace Tests\Unit;

use App\Models\Crew;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;


class SaveMovieTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function testSaveMovie()
    {
        $value =  [
            'title' => 'Test Movie',
            'year' => 2022,
            'rank' => 5,
            'description' => 'A test movie description',
            'genre_name' => 'Action',
            'crew_name' => 'John Doe',
            'family' => 'Doe Family',
            'role' => 'Actor',
            'birthdate' => '1990-01-01',
        ];

        $response = $this->post('/api/movie/create', $value);

        $response->assertStatus(200);

        $this->assertDatabaseHas('movies', [
            'title' => $value['title'],
            'year' => $value['year'],
            'rank' => $value['rank'],
            'description' => $value['description'],
        ]);

        $this->assertDatabaseHas('genres', [
            'name' => $value['genre_name'],
        ]);

        $this->assertDatabaseHas('crews', [
            'name' => $value['crew_name'],
            'family' => $value['family'],
            'role' => $value['role'],
            'birthdate' => $value['birthdate'],
        ]);
    }

    public function testUpdateMovie()
    {
        $movie = Movie::query()->first();
        $crew = Crew::query()->first();
        $genre = Genre::query()->first();

        $newTitle = 'Updated Movie Title';
        $newYear = 2024;
        $newRank = 8.2;
        $newDescription = 'Updated movie description';
        $newGenreName = 'Updated' . $genre->name;
        $newCrewName = 'Updated ' . $crew->name;
        $newFamily = 'Updated ' . $crew->family;
        $newRole = 'Updated ' . $crew->role;
        $newBirthdate = '1992-02-02';

        $response = $this->put(
            route('movie.update', $movie->id),
            [
                'title' => $newTitle,
                'year' => $newYear,
                'rank' => $newRank,
                'description' => $newDescription,
                'genre_name' => $newGenreName,
                'crew_name' => $newCrewName,
                'family' => $newFamily,
                'role' => $newRole,
                'birthdate' => $newBirthdate,
            ]
        );

        $response->assertStatus(200);

        $this->assertDatabaseHas('movies', [
            'title' => $newTitle,
            'year' => $newYear,
            'rank' => $newRank,
            'description' => $newDescription,
        ]);

        $this->assertDatabaseHas('genres', [
            'name' => $newGenreName,
        ]);

        $this->assertDatabaseHas('crews', [
            'name' => $newCrewName,
            'family' => $newFamily,
            'role' => $newRole,
            'birthdate' => $newBirthdate,
        ]);
    }

}
