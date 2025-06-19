<?php

namespace Tests\Feature;

use App\Models\Donut;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonutApiTest extends TestCase
{
    use RefreshDatabase; 

    public function can_fetch_donut_list()
    {
        Donut::create([
            'name' => 'Choco Glaze',
            'price' => 7.5,
            'seal_of_approval' => 4,
        ]);

        Donut::create([
            'name' => 'Vanilla Sky',
            'price' => 6.0,
            'seal_of_approval' => 5,
        ]);

        $response = $this->getJson('/api/donuts');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'price', 'seal_of_approval']
            ]
        ]);

        $response->assertJsonFragment([
            'name' => 'Choco Glaze',
        ]);
    }
