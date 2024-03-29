<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            'password' => Hash::make('WatchB33adm'),
            'activation_state' => false
        ])->assignRole('admin');

        User::create([
            'firstname' => 'Adminou',
            'lastname' => 'Miaou',
            'email' => 'admin-2@beewatch.ch',
            'password' => Hash::make('WatchB33'),
            'activation_state' => true
        ])->assignRole('admin');

        User::create([
            'firstname' => 'User',
            'lastname' => 'Tester',
            'email' => 'user@beewatch.ch',
            'password' => Hash::make('WatchB33'),
            'activation_state' => true
        ])->assignRole('user');

        User::create([
            'firstname' => 'utilisateur',
            'lastname' => 'tamboureine',
            'email' => 'utilisateur@tamboureine.ch',
            'password' => Hash::make('WatchB33'),
            'activation_state' => true
        ])->assignRole('user');

        User::create([
            'firstname' => 'superadmin',
            'lastname' => 'tamboureine',
            'email' => 'superadministrateur@tamboureine.ch',
            'password' => Hash::make('WatchB33'),
            'activation_state' => true
        ])->assignRole('superadmin');

        User::create([
            'firstname' => 'admin',
            'lastname' => 'tamboureine',
            'email' => 'administrateur@tamboureine.ch',
            'password' => Hash::make('WatchB33'),
            'activation_state' => true
        ])->assignRole('admin');
    }
}
