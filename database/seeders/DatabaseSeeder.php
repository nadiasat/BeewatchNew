<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apiary;
Use App\Models\Hive;
use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        SpatieRole::create(['name' => 'superadmin']);
        SpatieRole::create(['name' => 'admin']);
        SpatieRole::create(['name' => 'user']);

        //Manage users
        SpatiePermission::create(['name' => 'manage users'])->assignRole('superadmin');

        //Manage honey inventory
        SpatiePermission::create(['name' => 'manage honey inventory'])->assignRole('superadmin');

        //Manage apiaries
        SpatiePermission::create(['name' => 'manage apiaries'])->assignRole('superadmin', 'admin');

        //Manage hives
        SpatiePermission::create(['name' => 'manage hives'])->assignRole('superadmin', 'admin');

        //Manage documents
        SpatiePermission::create(['name' => 'manage documents'])->assignRole('superadmin', 'admin');

        //Manage equipment inventory
        SpatiePermission::create(['name' => 'manage equipment inventory'])->assignRole('superadmin', 'admin');


        // \App\Models\User::factory(10)->create();

        User::create([
            'firstname' => 'Superadmin',
            'lastname' => 'Tester',
            'email' => 'superadmin@beewatch.ch',
            'password' => Hash::make('WatchB33'),
            'activation_state' => true
        ])->assignRole('superadmin');

        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Tester',
            'email' => 'admin@beewatch.ch',
            'password' => Hash::make('WatchB33'),
            'activation_state' => false
        ])->assignRole('admin');

        User::create([
            'firstname' => 'temp',
            'lastname' => 'Tester',
            'email' => 'user@beewatch.ch',
            'password' => Hash::make('WatchB33'),
            'activation_state' => true
        ])->assignRole('user');

        Apiary::create([
            'name' => 'Test Apiary',
            'address' => 'Test Address',
        ])->users()->attach(1);

        Hive::create([
            'name' => 'Test Hive',
            'date_queen' => '2021-01-01',
            //hex color code red
            'color_queen' => '#FF0000',
            'rise' => true,
            'nb_frames' => 10,
            'nb_varroa' => 10,
            'is_active' => true,
            'apiary_id' => 1,
        ])->apiary()->associate(1);
        
        Hive::create([
            'name' => 'Test Inactive Hive',
            'date_queen' => null,
            'rise' => false,
            'nb_frames' => 0,
            'nb_varroa' => 0,
            'is_active' => false,
            'apiary_id' => 1,
        ])->apiary()->associate(1);

        //Events
        Event::create([
            'title' => 'Event Hier',
            'date_start' => now()->subDay(1)->format('Y-m-d'),
            'date_end' => now()->format('Y-m-d'),
            'description' => 'Description de l\'événement d\'hier',
        ])->users()->attach(1);

        Event::create([
            'title' => 'Event Demain',
            'date_start' => now()->addDay()->format('Y-m-d'),
            'date_end' => now()->addDay(2)->format('Y-m-d'),
            'description' => 'Description de l\'événement de demain',
            'is_urgent' => true,
        ])->users()->attach(1);

    }
}
