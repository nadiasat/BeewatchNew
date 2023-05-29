<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apiary>
 */
class ApiaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //fileds of model appiary
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
        ];
    }
}
