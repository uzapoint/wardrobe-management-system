<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->company(),
            "category" => fake()->randomElement(["shirt", "trouser", "jacket", "shoes"]),
            "size" => fake()->randomElement(["xs", "s", "m", "l", "xl"]),
            "color" => fake()->randomElement(["red", "blue", "black", "white"]),
            "user_id" => \App\Models\User::all()->random()->id
        ];
    }
}
