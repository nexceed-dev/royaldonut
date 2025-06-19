<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonutSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('donuts')->insert([
            ['name' => 'Moonlit Meringue', 'seal_of_approval' => 4, 'price' => 8, 'image' => 'storage/donuts/moonlit_meringue.png'],
            ['name' => 'Unicorn Rainbow', 'seal_of_approval' => 5, 'price' => 9.5, 'image' => 'storage/donuts/unicorn_rainbow.png'],
            ['name' => 'Starlight Sprinkle', 'seal_of_approval' => 3, 'price' => 7, 'image' => 'storage/donuts/starlight_sprinkle.png'],
            ['name' => 'Sunfire Glaze', 'seal_of_approval' => 5, 'price' => 8.5, 'image' => 'storage/donuts/sunfire_glaze.png'],
            ['name' => 'Dragon’s Breath', 'seal_of_approval' => 4, 'price' => 9, 'image' => 'storage/donuts/dragons_breath.png'],
            ['name' => 'Velvet Crème', 'seal_of_approval' => 2, 'price' => 6.5, 'image' => 'storage/donuts/velvet_creme.png'],
            ['name' => 'Aurora Swirl', 'seal_of_approval' => 4, 'price' => 8.2, 'image' => 'storage/donuts/aurora_swirl.png'],
            ['name' => 'Midnight Cocoa', 'seal_of_approval' => 3, 'price' => 7.8, 'image' => 'storage/donuts/midnight_cocoa.png'],
            ['name' => 'Royal Raspberry', 'seal_of_approval' => 5, 'price' => 9.2, 'image' => 'storage/donuts/royal_raspberry.png'],
            ['name' => 'Lemon Mist', 'seal_of_approval' => 3, 'price' => 7.3, 'image' => 'storage/donuts/lemon_mist.png'],
            ['name' => 'Caramel Crown', 'seal_of_approval' => 4, 'price' => 8.7, 'image' => 'storage/donuts/caramel_crown.png'],
            ['name' => 'Cherry Blossom', 'seal_of_approval' => 2, 'price' => 6.9, 'image' => 'storage/donuts/cherry_blossom.png'],
            ['name' => 'Mint Majesty', 'seal_of_approval' => 5, 'price' => 9, 'image' => 'storage/donuts/mint_majesty.png'],
            ['name' => 'Berry Bliss', 'seal_of_approval' => 3, 'price' => 7.5, 'image' => 'storage/donuts/berry_bliss.png'],
            ['name' => 'Golden Honeycomb', 'seal_of_approval' => 4, 'price' => 8.4, 'image' => 'storage/donuts/golden_honeycomb.png'],
        ]);

        DB::table('donuts')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
