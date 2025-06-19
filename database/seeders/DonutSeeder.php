<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonutSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('donuts')->insert([
            ['name' => 'Moonlit Meringue', 'seal_of_approval' => 4, 'price' => 8],
            ['name' => 'Unicorn Rainbow', 'seal_of_approval' => 5, 'price' => 9.5],
            ['name' => 'Starlight Sprinkle', 'seal_of_approval' => 3, 'price' => 7],
            ['name' => 'Sunfire Glaze', 'seal_of_approval' => 5, 'price' => 8.5],
            ['name' => 'Dragon’s Breath', 'seal_of_approval' => 4, 'price' => 9],
            ['name' => 'Velvet Crème', 'seal_of_approval' => 2, 'price' => 6.5],
            ['name' => 'Aurora Swirl', 'seal_of_approval' => 4, 'price' => 8.2],
            ['name' => 'Midnight Cocoa', 'seal_of_approval' => 3, 'price' => 7.8],
            ['name' => 'Royal Raspberry', 'seal_of_approval' => 5, 'price' => 9.2],
            ['name' => 'Lemon Mist', 'seal_of_approval' => 3, 'price' => 7.3],
            ['name' => 'Caramel Crown', 'seal_of_approval' => 4, 'price' => 8.7],
            ['name' => 'Cherry Blossom', 'seal_of_approval' => 2, 'price' => 6.9],
            ['name' => 'Mint Majesty', 'seal_of_approval' => 5, 'price' => 9],
            ['name' => 'Berry Bliss', 'seal_of_approval' => 3, 'price' => 7.5],
            ['name' => 'Golden Honeycomb', 'seal_of_approval' => 4, 'price' => 8.4],
        ]);
    }
}
