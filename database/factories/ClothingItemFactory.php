<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClothingItem>
 */
class ClothingItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wardrobe_id' => \App\Models\Wardrobe::inRandomOrder()->first()->id,
            'drawer_id' => \App\Models\Drawer::inRandomOrder()->first()->id,
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'clothing_name' => $this->faker->word(),
            'color' => $this->faker->colorName(),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            // 'image' => $this->faker->image('public/storage/clothing_items', 640, 480, null, false),
        ];
    }
}
