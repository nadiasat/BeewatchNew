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
            'name' => 'Nouriture',
            'inventory_place_id' => 1,
            'max_stock' => 10,
            'associated_to' => 'food',
            'current_stock' => 10,
        ])->inventory_place()->associate(1);

        Material::create([
            'name' => 'Cadres',
            'inventory_place_id' => 1,
            'max_stock' => 8,
            'associated_to' => 'frames',
            'current_stock' => 4,
        ])->inventory_place()->associate(1);

        Material::create([
            'name' => 'Séparateurs',
            'inventory_place_id' => 1,
            'max_stock' => 8,
            'associated_to' => 'separators',
            'current_stock' => 8,
        ])->inventory_place()->associate(1);

        Material::create([
            'name' => 'Hausses',
            'inventory_place_id' => 1,
            'max_stock' => 5,
            'associated_to' => 'rise',
            'current_stock' => 0,
        ])->inventory_place()->associate(1);


        Material::create([
            'name' => 'Cadres',
            'inventory_place_id' => 2,
            'max_stock' => 10,
            'associated_to' => 'frames',
            'current_stock' => 10,
        ])->inventory_place()->associate(2);
    }
}
