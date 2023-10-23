<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apiary;
use App\Models\User;

class ApiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Get all users id in array
        $users = User::all()->pluck('id')->toArray();

        //sync all user except last one
        Apiary::create([
            'name' => 'Rucher Drize',
            'address' => 'Route de drize 1, 1227 Carouge',
            'inventory_place_id' => 1,
        ])->inventory_place()->associate(1)->users()->sync($users);

        Apiary::create([
            'name' => 'Rucher Batelle',
            'address' => 'Rue de la Tambourine 17, 1227 Carouge',
        ])->users()->sync($users);
    }
}
