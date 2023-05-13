<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\HoneyJar;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // \App\Models\User::factory(10)->create();
        
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ApiarySeeder::class,
            HiveSeeder::class,
            EventSeeder::class,
            InventoryPlaceSeeder::class,
            MaterialSeeder::class,
            HoneyJarSeeder::class,
        ]);


    }
}
