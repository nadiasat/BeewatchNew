<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        //Manage honey
        SpatiePermission::create(['name' => 'manage honey'])->assignRole('superadmin' , 'admin', 'user');

        //Manage apiaries
        SpatiePermission::create(['name' => 'manage apiaries'])->assignRole('superadmin', 'admin');

        //Manage hives
        SpatiePermission::create(['name' => 'manage hives'])->assignRole('superadmin', 'admin', 'user');

        //Manage documents
        SpatiePermission::create(['name' => 'manage documents'])->assignRole('superadmin', 'admin');

        //Manage material
        SpatiePermission::create(['name' => 'manage materials'])->assignRole('superadmin', 'admin', 'user');

    }
}
