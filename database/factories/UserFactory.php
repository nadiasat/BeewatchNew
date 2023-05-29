<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => fake()->name(),
            'lastname' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('WatchB33'),
            'activation_state' => true,
            'remember_token' => Str::random(10),
        ];

        //assign role to user
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function awaiting_activation()
    {
        return $this->state(fn (array $attributes) => [
            'activation_state' => false,
        ]);
    }

}
