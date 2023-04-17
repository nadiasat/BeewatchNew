<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::create([
            'title' => 'Event Hier',
            'date_start' => now()->subDay(1)->format('Y-m-d'),
            'date_end' => now()->format('Y-m-d'),
            'description' => 'Description de l\'événement d\'hier',
        ])->users()->sync([1, 3]);

        Event::create([
            'title' => 'Event Demain',
            'date_start' => now()->addDay()->format('Y-m-d'),
            'date_end' => now()->addDay(2)->format('Y-m-d'),
            'description' => 'Description de l\'événement de demain',
            'is_urgent' => true,
        ])->users()->sync([3, 4]);
    }
}
