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
        $this->call(DonutSeeder::class);
    }
}
