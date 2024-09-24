<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cloth;

class ClothesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add dummy clothing items to the database
        Cloth::create([
            'name' => 'T-shirt',
            'category' => 'Top',
            'size' => 'M',
            'color' => 'Black',
            'image' => 'tshirt_image_url'
        ]);

        Cloth::create([
            'name' => 'Jacket',
            'category' => 'Outerwear',
            'size' => 'L',
            'color' => 'Blue',
            'image' => 'jacket_image_url'
        ]);

        Cloth::create([
            'name' => 'Jeans',
            'category' => 'Bottom',
            'size' => '32',
            'color' => 'Denim Blue',
            'image' => 'jeans_image_url'
        ]);

        Cloth::create([
            'name' => 'Sneakers',
            'category' => 'Footwear',
            'size' => '42',
            'color' => 'White',
            'image' => 'sneakers_image_url'
        ]);
    }
}

