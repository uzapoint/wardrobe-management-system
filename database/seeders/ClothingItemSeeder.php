<?php

namespace Database\Seeders;

use App\Models\ClothingItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClothingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClothingItem::factory()->count(30)->create();
    }
}
