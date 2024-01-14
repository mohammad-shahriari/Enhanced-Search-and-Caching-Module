<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaveCrewTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testSaveCrew()
    {
        $value = [
            'crew_name' => 'John Doe',
            'family' => 'Doe Family',
            'role' => 'Actor',
            'birthdate' => '1990-01-01',
        ];

        $response = $this->post('/api/crew/create', $value);

        $response->assertStatus(200);

        $this->assertDatabaseHas('crews', [
            'name' => $value['crew_name'],
            'family' => $value['family'],
            'role' => $value['role'],
            'birthdate' => $value['birthdate'],
        ]);
    }
}
