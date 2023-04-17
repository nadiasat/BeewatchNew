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
            'password' => 'WatchB33',
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
    }
}
