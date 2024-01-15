<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaveGenreTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function testSaveGenre()
    {
        $value = ['genre_name' => 'Action'];


        $response = $this->post('/api/genre/create', $value);

        $response->assertStatus(200);

        $this->assertDatabaseHas('genres', [
            'name' => $value['genre_name'],
        ]);
    }

}
