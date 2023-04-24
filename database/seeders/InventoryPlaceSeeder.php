<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InventoryPlace;

class InventoryPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryPlace::create([
            'name' => 'Tambourine',
            'address' => 'Rue de la Tambourine 17, 1227 Carouge',
        ]);
    }
}
