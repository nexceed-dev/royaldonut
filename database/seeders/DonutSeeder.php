<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonutSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('donuts')->insert([
            ['name' => 'Moonlit Meringue', 'seal_of_approval' => 4, 'price' => 8, 'image' => 'storage/donuts/moonlit-meringue.jpg'],
            ['name' => 'Unicorn Rainbow', 'seal_of_approval' => 5, 'price' => 9.5, 'image' => 'storage/donuts/unicorn-rainbow.jpg'],
            ['name' => 'Starlight Sprinkle', 'seal_of_approval' => 3, 'price' => 7, 'image' => 'storage/donuts/starlight-sprinkle.jpg'],
            ['name' => 'Sunfire Glaze', 'seal_of_approval' => 5, 'price' => 8.5, 'image' => 'storage/donuts/sunfire-glaze.jpg'],
            ['name' => 'Dragon’s Breath', 'seal_of_approval' => 4, 'price' => 9, 'image' => 'storage/donuts/dragons-breath.jpg'],
            ['name' => 'Velvet Crème', 'seal_of_approval' => 2, 'price' => 6.5, 'image' => 'storage/donuts/velvet-creme.jpg'],
            ['name' => 'Aurora Swirl', 'seal_of_approval' => 4, 'price' => 8.2, 'image' => 'storage/donuts/aurora-swirl.jpg'],
            ['name' => 'Midnight Cocoa', 'seal_of_approval' => 3, 'price' => 7.8, 'image' => 'storage/donuts/midnight-cocoa.jpg'],
            ['name' => 'Royal Raspberry', 'seal_of_approval' => 5, 'price' => 9.2, 'image' => 'storage/donuts/royal-raspberry.jpg'],
            ['name' => 'Lemon Mist', 'seal_of_approval' => 3, 'price' => 7.3, 'image' => 'storage/donuts/lemon-mist.jpg'],
            ['name' => 'Caramel Crown', 'seal_of_approval' => 4, 'price' => 8.7, 'image' => 'storage/donuts/caramel-crown.jpg'],
            ['name' => 'Cherry Blossom', 'seal_of_approval' => 2, 'price' => 6.9, 'image' => 'storage/donuts/cherry-blossom.jpg'],
            ['name' => 'Mint Majesty', 'seal_of_approval' => 5, 'price' => 9, 'image' => 'storage/donuts/mint-majesty.jpg'],
            ['name' => 'Berry Bliss', 'seal_of_approval' => 3, 'price' => 7.5, 'image' => 'storage/donuts/berry-bliss.jpg'],
            ['name' => 'Golden Honeycomb', 'seal_of_approval' => 4, 'price' => 8.4, 'image' => 'storage/donuts/golden-honeycomb.jpg'],
        ]);
    }
}
