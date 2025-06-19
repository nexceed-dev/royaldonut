<?php

namespace Tests\Feature;

use App\Models\Donut;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DonutApiTest extends TestCase
{
    use RefreshDatabase; 

    #[Test]
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

    #[Test]
    public function can_sort_by_name_and_seal_of_approval()
    {
        Donut::create([
            'name' => 'Apple Cinnamon',
            'price' => 7.5,
            'seal_of_approval' => 1,
        ]);

        Donut::create([
            'name' => 'Zebra Stripes',
            'price' => 6.0,
            'seal_of_approval' => 5,
        ]);

        $response = $this->getJson('/api/donuts?sort=name&order=asc');
        $response->assertStatus(200);
        $response->assertJsonPath('data.0.name', 'Apple Cinnamon');
        $response->assertJsonPath('data.1.name', 'Zebra Stripes');

        $response = $this->getJson('/api/donuts?sort=approval&order=desc');
        $response->assertStatus(200);
        $response->assertJsonPath('data.0.seal_of_approval', 5);
        $response->assertJsonPath('data.1.seal_of_approval', 1);
    }
}
