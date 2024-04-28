<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

require_once 'vendor/autoload.php';

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    private $array = [1, 2, 3];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $a = $this->array;
        $num = fake()->randomElement($this->array);
        $this->array = array_filter($this->array, function ($element) use ($num) {
            return $element !== $num;
        });
        $imagename = "DefaultRandomPlace" . $num . ".jpg";
        return [
            'name' => fake()->city(),
            'imagename' => $imagename,
            'imagename_hash' => $imagename,
        ];
    }
}
