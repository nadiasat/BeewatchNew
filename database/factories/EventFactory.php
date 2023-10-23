<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'date_start' => $this->faker->date(),
            'date_end' => $this->faker->date(),
            'description' => $this->faker->text(),
            'is_urgent' => $this->faker->boolean()
        ];
    }
}
