<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalendarTest extends TestCase
{
    
    //Test if the calendar page can be rendered acting as user
    public function test_calendar_page_can_be_rendered()
    {
        $user = User::factory()->create();

        $event = Event::factory()->create();

        // call the route index
        $response = $this->actingAs($user)->get(route('events'));

        // assert response status
        $response->assertStatus(200);
    }

    // Test if an event can be created acting as user and assert if the event has been created
    public function test_event_can_be_created(){
        
        $user = User::factory()->create();

        // call the route store with parameters in the uri and new title, date_start and date_end
        $response = $this->actingAs($user)->post(route('events.store'), ['title' => 'test', 'date_start' => '2023-01-10','date_end' => '2023-01-12']);

        // assert response status
        $response->assertStatus(302);

        // assert if event has been created
        $this->assertDatabaseHas('events', [
            'title' => 'test',
            'date_start' => '2023-01-10',
            'date_end' => '2023-01-12',
        ]);
    }

    // Test if an event can be modified acting as user and assert if the event has been modified
    public function test_event_can_be_modified(){
        
        $user = User::factory()->create();

        $event = Event::factory()->create();

        $event_id = $event->id;

        // call the route update with parameters in the uri and new title, date_start and date_end
        $response = $this->actingAs($user)->put(route('events.update', [$event_id]), ['title' => 'modified test', 'date_start' => '2023-01-10','date_end' => '2023-01-12']);

        // assert response status
        $response->assertStatus(302);

        // assert if event has been modified
        $this->assertDatabaseHas('events', [
            'title' => 'modified test',
            'date_start' => '2023-01-10',
            'date_end' => '2023-01-12',

        ]);
    }

    // Test if an event can be deleted acting as user and assert if the event has been deleted
    public function test_event_can_be_deleted(){
        
        $user = User::factory()->create();

        $event = Event::factory()->create();

        $event_id = $event->id;

        // call the route destroy with parameters in the uri
        $response = $this->actingAs($user)->delete(route('events.destroy', [$event_id]));

        // assert response status
        $response->assertStatus(302);

        // assert if event has been deleted
        $this->assertDatabaseMissing('events', [
            'id' => $event_id,
        ]);
    }
}
