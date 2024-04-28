<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

require_once 'vendor/autoload.php';

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $num = fake()->numberBetween(1, 3);
        $imagename = "RandomCity".$num.".jpg";

        $image = fake()->image(null, 360, 360, 'animals', true, true, 'cats', true, 'jpg');

        return [
            'name' => fake()->city(),
            'imagename' => $imagename,
            'imagename_hash' => $imagename,
        ];
    }
}
