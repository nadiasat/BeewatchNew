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
        $hive_1 = Hive::create([
            'name' => 'Ginette',
            'date_queen' => now()->format('d/m/Y'),
            //hex color code red
            'color_queen' => '#EE82EE',
            'rise' => true,
            'max_nb_frames' => 10,
            'frames_slots' => 'e,e,e,c,c,c,c,e,e,e',
            'nb_varroa' => 10,
            'treatment' => 'varroas',
            'intensity' => 2,
            'is_active' => true,
            'apiary_id' => 1,

        ])->apiary()->associate(1);

        
        Hive::create([
            'name' => 'Claude',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'max_nb_frames' => 10,
            'frames_slots' => 'e,e,e,e,e,e,e,e,e,e',
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 1,

        ])->apiary()->associate(1);

        Hive::create([
            'name' => 'Gertrude',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'max_nb_frames' => 10,
            'frames_slots' => 'e,e,e,e,e,e,e,e,e,e',
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 1,

        ])->apiary()->associate(1);

        #APIARY 2 -----------------------------------------------      
        Hive::create([
            'name' => 'Henri',
            'date_queen' => now()->format('d/m/Y'),
            'color_queen' => '#FF0000',
            'rise' => true,
            'max_nb_frames' => 4,
            'frames_slots' => 'e,c,c,e',
            'nb_varroa' => 12,
            'is_active' => true,
            'apiary_id' => 2,

        ])->apiary()->associate(2);
        
        Hive::create([
            'name' => 'Pierre',
            'date_queen' => now()->format('d/m/Y'),
            'color_queen' => '#FFFF00',
            'rise' => false,
            'max_nb_frames' => 5,
            'frames_slots' => 'e,e,e,e,e',
            'nb_varroa' => 13,
            'is_active' => true,
            'apiary_id' => 2,

        ])->apiary()->associate(2);

        Hive::create([
            'name' => 'Bertrand',
            'date_queen' => now()->format('d/m/Y'),
            'color_queen' => '#008000',
            'rise' => false,
            'max_nb_frames' => 9,
            'frames_slots' => 'e,e,e,e,e,e,e,e,e',
            'nb_varroa' => 17,
            'is_active' => true,
            'apiary_id' => 2,

        ])->apiary()->associate(2);

        Hive::create([
            'name' => 'Aristote',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'max_nb_frames' => 10,
            'frames_slots' => 'e,e,e,e,e,e,e,e,e,e',
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 2,

        ])->apiary()->associate(2);

        Hive::create([
            'name' => 'Hyppolite',
            'date_queen' => null,
            'color_queen' => null,
            'rise' => false,
            'max_nb_frames' => 10,
            'frames_slots' => 'e,e,e,e,e,e,e,e,e,e',
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 2,

        ])->apiary()->associate(2);
    }
}
