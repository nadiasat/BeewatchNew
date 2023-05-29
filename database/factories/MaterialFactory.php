<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\InventoryPlace;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // 'name',
        // 'current_stock',
        // 'max_stock',
        // 'inventory_place_id'
        return [
            'name' => $this->faker->name(),
            'current_stock' => $this->faker->numberBetween(1, 5),
            'max_stock' => $this->faker->numberBetween(5, 10),
            'inventory_place_id' => InventoryPlace::factory(),
        ];
    }
}
