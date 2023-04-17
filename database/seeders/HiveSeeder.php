<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

Use App\Models\Hive;
Use App\Models\Apiary;

class HiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        #APIARY 1 -----------------------------------------------
        Hive::create([
            'name' => 'Ginette',
            'date_queen' => now()->format('Y-m-d'),
            //hex color code red
            'color_queen' => '#EE82EE',
            'rise' => true,
            'nb_frames' => 10,
            'nb_varroa' => 10,
            'is_active' => true,
            'apiary_id' => 1,
        ])->apiary()->associate(1);
        
        Hive::create([
            'name' => 'Claude',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'nb_frames' => 0,
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 1,
        ])->apiary()->associate(1);

        Hive::create([
            'name' => 'Gertrude',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'nb_frames' => 0,
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 1,
        ])->apiary()->associate(1);

        #APIARY 2 -----------------------------------------------      
        Hive::create([
            'name' => 'Henri',
            'date_queen' => now()->format('Y-m-d'),
            'color_queen' => '#FF0000',
            'rise' => true,
            'nb_frames' => 4,
            'nb_varroa' => 12,
            'is_active' => true,
            'apiary_id' => 2,
        ])->apiary()->associate(2);
        
        Hive::create([
            'name' => 'Pierre',
            'date_queen' => now()->format('Y-m-d'),
            'color_queen' => '#FFFF00',
            'rise' => false,
            'nb_frames' => 5,
            'nb_varroa' => 13,
            'is_active' => true,
            'apiary_id' => 2,
        ])->apiary()->associate(2);

        Hive::create([
            'name' => 'Bertrand',
            'date_queen' => now()->format('Y-m-d'),
            'color_queen' => '#008000',
            'rise' => false,
            'nb_frames' => 9,
            'nb_varroa' => 17,
            'is_active' => true,
            'apiary_id' => 2,
        ])->apiary()->associate(2);

        Hive::create([
            'name' => 'Aristote',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'nb_frames' => 0,
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 2,
        ])->apiary()->associate(2);

        Hive::create([
            'name' => 'Hyppolite',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'nb_frames' => 0,
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 2,
        ])->apiary()->associate(2);


        #APIARY 3 -----------------------------------------
        Hive::create([
            'name' => 'Gaston',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'nb_frames' => 0,
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 3,
        ])->apiary()->associate(3);

        Hive::create([
            'name' => 'Jean',
            'date_queen' => now()->format('Y-m-d'),
            'color_queen' => '#0000FF',
            'rise' => true,
            'nb_frames' => 10,
            'nb_varroa' => 15,
            'is_active' => true,
            'apiary_id' => 3,
        ])->apiary()->associate(3);

        Hive::create([
            'name' => 'Paul',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'nb_frames' => 0,
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 3,
        ])->apiary()->associate(3);

        Hive::create([
            'name' => 'Jacques',
            'date_queen' => now()->format('Y-m-d'),
            'color_queen' => '#0000FF',
            'rise' => false,
            'nb_frames' => 12,
            'nb_varroa' => 6,
            'is_active' => true,
            'apiary_id' => 3,
        ])->apiary()->associate(3);
    }
}
