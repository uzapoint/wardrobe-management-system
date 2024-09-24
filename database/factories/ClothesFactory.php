<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clothes>
 */
class ClothesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'color' => $this->faker->colorName(),
            'image' => $this->faker->imageUrl(640, 480, 'clothes'),
            'user_id' => User::inRandomOrder()->first()->id, 
            'category_id' => Category::inRandomOrder()->first()->id, 
        ];
    }
}
