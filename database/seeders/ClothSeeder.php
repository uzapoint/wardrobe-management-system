<?php

namespace Database\Seeders;

use App\Models\Cloth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClothSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cloth::factory(10)->create();
    }
}
