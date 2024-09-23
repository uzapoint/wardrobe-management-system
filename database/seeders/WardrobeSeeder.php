<?php

namespace Database\Seeders;

use App\Models\Wardrobe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WardrobeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Wardrobe::factory()->count(30)->create();
    }
}
