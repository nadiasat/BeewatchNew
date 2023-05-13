<?php

namespace Database\Seeders;

use App\Models\HoneyJar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoneyJarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HoneyJar::Create([
            'size' => '1kg',
            'nb_jar' => 5,
        ])->users()->attach(1, ['nb_jar' => 2]);

        HoneyJar::Create([
            'size' => '500g',
            'nb_jar' => 2,
        ])->users()->attach(1, ['nb_jar' => 1]);;

        HoneyJar::Create([
            'size' => '250g',
            'nb_jar' => 6,
        ]);
    }
}
