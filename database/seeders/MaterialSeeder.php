<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::create([
            'name' => 'Sirop',
            'inventory_place_id' => 1,
            'max_stock' => 10,
            'current_stock' => 10,
        ])->inventory_place()->associate(1);

        Material::create([
            'name' => 'Cadres',
            'inventory_place_id' => 1,
            'max_stock' => 8,
            'current_stock' => 2,
        ])->inventory_place()->associate(1);

        Material::create([
            'name' => 'Hausses',
            'inventory_place_id' => 1,
            'max_stock' => 5,
            'current_stock' => 0,
        ])->inventory_place()->associate(1);
    }
}
