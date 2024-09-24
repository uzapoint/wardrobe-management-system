<?php

namespace Database\Seeders;

use App\Models\ClothingItemOutfit;
use Illuminate\Database\Seeder;

class ClothingItemOutfitSeeder extends Seeder
{
    public function run()
    {
        $clothingItemOutfit = [
            [
                'clothing_item_id' => 1, // Assuming 'Casual Shirt' has ID 1
                'outfit_id' => 1,        // Assuming 'Casual Outfit' has ID 1
            ],
            [
                'clothing_item_id' => 2, // Assuming 'Jeans' has ID 2
                'outfit_id' => 1,        // Assuming 'Casual Outfit' has ID 1
            ],
            // Add more relationships as needed
        ];

        foreach ($clothingItemOutfit as $itemOutfit) {
            ClothingItemOutfit::create($itemOutfit);
        }
    }
}
