<?php

namespace Database\Seeders;

use App\Models\ClothingItem;
use Illuminate\Database\Seeder;

class ClothingItemSeeder extends Seeder
{
    public function run()
    {
        $clothingItems = [
            [
                'name' => 'Casual Shirt',
                'image' => 'images/casual-shirt.jpg',
                'size' => 'M',
                'color' => 'Blue',
                'material' => 'Cotton',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'Jeans',
                'image' => 'images/jeans.jpg',
                'size' => '32',
                'color' => 'Dark Blue',
                'material' => 'Denim',
                'category_id' => 2,
                'user_id' => 1,
            ],
            // Add more clothing items as needed
        ];

        foreach ($clothingItems as $item) {
            ClothingItem::create($item);
        }
    }
}
