<?php

namespace Database\Factories;

use App\Models\Apiary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hive>
 */
class HiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //fileds of model hive
        // 'name',
        // 'date_queen',
        // 'color_queen',
        // 'treatment',
        // 'intensity',
        // 'food',
        // 'rise',
        // 'max_nb_frames',
        // 'frames_slots',
        // 'nb_varroa',
        // 'is_active',
        // 'apiary_id'
        //is active depends on date_queen
        return [
            'name' => $this->faker->name(),
            'date_queen' => $this->faker->date(),
            'color_queen' => $this->faker->hexColor(),
            'treatment' => $this->faker->randomElement(["none", "varroas", "sickness"]),
            'intensity' => $this->faker->numberBetween(0, 3),
            'food' => $this->faker->boolean(),
            'rise' => $this->faker->boolean(),
            'frames_slots' => $this->faker->randomElement(["e,e,e,e,e,e,e,e,e,e", "e,e,e,e,c,c,c,s,e,e", "e,e,c,c,c,c,c,c,e,e"]),
            'nb_varroa' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
            'apiary_id' => Apiary::factory(),
        ];
    }

    /**
     * Indicate that the hive is inactive.
     * 
     * @return static
     */
    public function inactive()
    {
        return $this->state(fn (array $attributes) => [
            'date_queen' => null,
            'is_active' => false,
        ]);
    }
}
