<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cloth>
 */
class ClothFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> User::factory(),
            'cloth_name' => $this->faker->word,
            'category' => $this->faker->word,
            'color' => $this->faker->safeColorName,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'image' => $this->faker->imageUrl(640, 480, 'fashion'),

        ];
    }
}
