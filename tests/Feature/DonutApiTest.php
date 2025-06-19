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

    #[Test]
    public function can_fetch_single_donut()
    {
        $donut = Donut::create([
            'name' => 'Chocolate Dream',
            'price' => 8.0,
            'seal_of_approval' => 5,
        ]);

        $response = $this->getJson("/api/donuts/{$donut->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Chocolate Dream']);
        $response->assertJsonFragment(['price' => 8.0]);
        $response->assertJsonFragment(['seal_of_approval' => 5]);
    }
    
    #[Test]
    public function can_create_donut()
    {
        $response = $this->postJson('/api/donuts', [
            'name' => 'Maple Delight',
            'price' => 8.0,
            'seal_of_approval' => 5,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Maple Delight']);
        $this->assertDatabaseHas('donuts', ['name' => 'Maple Delight']);
    #[Test]
    public function return_error_for_invalid_input()
    {
        $response = $this->postJson('/api/donuts', [
            'name' => '',
            'price' => 'not_a_number',
            'seal_of_approval' => '6',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Invalid input',
            'error' => [
                'name' => ['The name field is required.'],
                'price' => ['The price field must be a number.'],
                'seal_of_approval' => ['The seal of approval field must not be greater than 5.'],
            ],
        ]);
        $this->assertDatabaseMissing('donuts', ['name' => '']);
        $this->assertDatabaseMissing('donuts', ['price' => 'not_a_number']);
        $this->assertDatabaseMissing('donuts', ['seal_of_approval' => '6']);
    }

    }
}
