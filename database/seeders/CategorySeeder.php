<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Tops'],
            ['name' => 'Bottoms'],
            ['name' => 'Dresses'],
            ['name' => 'Outerwear'],
            ['name' => 'Footwear'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
