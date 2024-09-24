<?php

namespace Database\Seeders;

use App\Models\Outfit;
use Illuminate\Database\Seeder;

class OutfitSeeder extends Seeder
{
    public function run()
    {
        $outfits = [
            [
                'name' => 'Casual Outfit',
                'user_id' => 1, // Assuming a user with ID 1 exists
            ],
            [
                'name' => 'Party Outfit',
                'user_id' => 1, // Assuming a user with ID 1 exists
            ],
            // Add more outfits as needed
        ];

        foreach ($outfits as $outfit) {
            Outfit::create($outfit);
        }
    }
}
