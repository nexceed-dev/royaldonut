<?php

namespace Tests\Feature;

use App\Models\Donut;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class DonutApiTest extends TestCase
{
    use RefreshDatabase; 

    #[Test]
    public function can_fetch_donut_list()
    {
        $image = UploadedFile::fake()->image('maple_delight.png');

        Donut::create([
            'name' => 'Choco Glaze',
            'price' => 7.5,
            'seal_of_approval' => 4,
            'image' => $image->store('donuts', 'public'),
        ]);

        Donut::create([
            'name' => 'Vanilla Sky',
            'price' => 6.0,
            'seal_of_approval' => 5,
            'image' => $image->store('donuts', 'public'),
        ]);

        $response = $this->getJson('/api/donuts');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'price', 'seal_of_approval', 'image',]
            ]
        ]);

        $response->assertJsonFragment([
            'name' => 'Choco Glaze',
        ]);
    }

    #[Test]
    public function can_sort_by_name_and_seal_of_approval()
    {
        $image = UploadedFile::fake()->image('maple_delight.png');

        Donut::create([
            'name' => 'Apple Cinnamon',
            'price' => 7.5,
            'seal_of_approval' => 1,
            'image' => $image->store('donuts', 'public'),
        ]);

        Donut::create([
            'name' => 'Zebra Stripes',
            'price' => 6.0,
            'seal_of_approval' => 5,
            'image' => $image->store('donuts', 'public'),
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
            'image' => 'storage/donuts/chocolate_dream.png',
        ]);

        $response = $this->getJson("/api/donuts/{$donut->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Chocolate Dream']);
        $response->assertJsonFragment(['price' => 8.0]);
        $response->assertJsonFragment(['seal_of_approval' => 5]);
        $response->assertJsonFragment(['image' => 'storage/donuts/chocolate_dream.png']);
    }
    
    #[Test]
    public function can_create_donut()
    {
        $image = UploadedFile::fake()->image('maple_delight.png');

        $response = $this->postJson('/api/donuts', [
            'name' => 'Maple Delight',
            'price' => 8.0,
            'seal_of_approval' => 5,
            'image' => $image,
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Maple Delight']);
        $response->assertJsonFragment(['price' => 8.0]);
        $response->assertJsonFragment(['seal_of_approval' => 5]);
        $response->assertJsonFragment(['message' => 'Donut created successfully']);

    }

    #[Test]
    public function return_error_for_invalid_input()
    {
        $response = $this->post('/api/donuts', [
            'name' => '',
            'price' => 'not_a_number',
            'seal_of_approval' => '6',
            'image' => UploadedFile::fake()->create('invalid_image.docx'),
        ]);

        $response->assertStatus(200);

        $response->assertJsonFragment(['message' => 'Invalid input']);
        $response->assertJsonFragment(['name' => ['The name field is required.']]);
        $response->assertJsonFragment(['price' => ['The price field must be a number.']]);
        $response->assertJsonFragment(['seal_of_approval' => ['The seal of approval field must not be greater than 5.']]);

        $errorImage = $response->json('error.image');
        if (isset($errorImage)) {
            $response->assertJsonFragment([
                'image' => ['The image must be a file of type: jpeg, png, jpg, gif.']
            ]);
        }
    }


    #[Test]
    public function can_delete_donut()
    {
        $donut = Donut::create([
            'name' => 'Apple Cinnamon',
            'price' => 7.5,
            'seal_of_approval' => 1,
            'image' => 'storage/donuts/apple_cinnamon.png',
        ]);

        $response = $this->deleteJson("/api/donuts/{$donut->id}");
        $response->assertStatus(200);
        $response->assertJsonFragment(['message' => 'Donut deleted successfully']);
        $this->assertDatabaseMissing('donuts', ['id' => $donut->id]);
        $this->assertDatabaseMissing('donuts', ['name' => 'Apple Cinnamon']);
        $this->assertDatabaseMissing('donuts', ['price' => 7.5]);
        $this->assertDatabaseMissing('donuts', ['seal_of_approval' => 1]);
        $this->assertDatabaseMissing('donuts', ['image' => 'storage/donuts/apple_cinnamon.png']);
    }
}
