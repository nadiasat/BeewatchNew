<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hive;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interventions>
 */
class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // 'type',
        // 'hive_id'
        return [
            'type' => $this->faker->name(),
            'hive_id' => Hive::factory(),
        ];
    }
}
