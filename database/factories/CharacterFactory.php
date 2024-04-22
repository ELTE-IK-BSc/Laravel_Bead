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
        $str = fake()->numberBetween(0, 20);
        $acc = fake()->numberBetween(0, (20 - $str));
        $mag = fake()->numberBetween(0, (20 - $acc - $str));

        return [
            'name' => fake()->firstName(),
            'enemy' => false,
            'defence' => fake()->numberBetween(0, 3),
            'strength' => $str,
            'accuracy' => $acc,
            'magic' => $mag,
        ];
    }
}
