<?php

namespace Tests\Unit;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;


class SaveMovieTest extends TestCase
{
    use RefreshDatabase;
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
            'genre_name' => 'Action', // Sample genre name
            'crew_name' => 'John Doe', // Sample crew name
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
}
