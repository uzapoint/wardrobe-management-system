<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drawer>
 */
class DrawerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $drawers = ['shirt', 'pants', 'jacket', 'sweaters', 'socks'];

        return [
            'wardrobe_id' => \App\Models\Wardrobe::inRandomOrder()->first()->id,
            'drawer_name' => 'Drawer ' .  $drawers[\rand(0, count($drawers) - 1)],
        ];


        // return [
        //     'wardrobe_id' => \App\Models\Wardrobe::inRandomOrder()->first()->id,
        //     'drawer_name' => 'Drawer ' . $this->faker->word(),
        // ];
    }
}
