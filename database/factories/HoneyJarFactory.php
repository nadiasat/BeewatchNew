<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HoneyJar>
 */
class HoneyJarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'size' => $this->faker->bothify(),
            'nb_jar' => $this->faker->numberBetween(1, 20)
        ];
    }
}
