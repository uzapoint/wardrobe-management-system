<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wardrobe>
 */
class WardrobeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $wardrobes = [
            'A',
            'B',
            'C',
            'D',
            'E',
        ];

        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'wardrobe_name' => 'Wardrobe ' .  $wardrobes[\rand(0, count($wardrobes) - 1)],
        ];
    }
}
