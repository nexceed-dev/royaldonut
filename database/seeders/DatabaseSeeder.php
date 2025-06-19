<?php

namespace Database\Seeders;

use App\Models\Donut;
use App\Models\User;
use Database\Seeders\DonutSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the DonutSeeder to seed the donuts table
        $this->call(DonutSeeder::class);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
