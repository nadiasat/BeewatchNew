<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\HoneyJar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HoneyRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'honey_jar_id' => HoneyJar::factory(),
            'user_id' => User::factory(),
            'other_person' => null,
            'nb_jar' => 1
        ];
    }
}
