<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $def = fake()->numberBetween(0, 3);
        $str = fake()->numberBetween(0, (20 - $def));
        $acc = fake()->numberBetween(0, (20 - $def - $str));
        $mag = fake()->numberBetween(0, (20 - $def - $acc - $str));

        return [
            'name' => fake()->firstName(),
            'enemy' => false,
            'defence' => $def,
            'strength' => $str,
            'accuracy' => $acc,
            'magic' => $mag,
        ];
    }
}
