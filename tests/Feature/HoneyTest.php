<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\HoneyJar;

class HoneyTest extends TestCase
{
    
    // Test if honeyjar can be created acting as user and assert if the honeyjar has been created
    public function test_honeyjar_can_be_created()
    {
        $user = User::factory()->create();

        // call the route to create a honeyjar
        $response = $this->actingAs($user)->post(route('inventoryHoney.store'), ['size' => 'test','nb_jar' => 1]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the honeyjar has been created in the database
        $this->assertDatabaseHas('honey_jars', [
            'size' => 'test',
            'nb_jar' => 1
        ]);

    }

    // Test if honeyjar can be modified acting as user and assert if the honeyjar has been modified
    public function test_honeyjar_can_be_modified()
    {
        $user = User::factory()->create();
        
        $honeyjar = HoneyJar::factory()->create();

        $honeyjar_id = $honeyjar->id;

        // call the route to modify a honeyjar
        $response = $this->actingAs($user)->put(route('inventoryHoney.update', [$honeyjar_id]), ['nb_jar' => 1, 'honey_jar' => $honeyjar]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the honeyjar has been modified in the database
        $this->assertDatabaseHas('honey_jars', [
            'id' => $honeyjar_id,
            'nb_jar' => 1
        ]);

    }

    // Test if honeyjar can be deleted acting as user and assert if the honeyjar has been deleted
    public function test_honeyjar_can_be_deleted()
    {
        $user = User::factory()->create();
        
        $honeyjar = HoneyJar::factory()->create();

        $honeyjar_id = $honeyjar->id;

        // call the route to delete a honeyjar
        $response = $this->actingAs($user)->delete(route('inventoryHoney.destroy', [$honeyjar_id]), ['honey_jar_id' => $honeyjar_id]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the honeyjar has been deleted in the database
        $this->assertDatabaseHas('honey_jars', [
            'id' => $honeyjar_id,
            'deleted_at' => now()
        ]);
    }

    // Test if honey record can be created acting as user and assert if the honey record has been created
    public function test_honey_record_can_be_created()
    {
        $user = User::factory()->create();
        
        $honeyjar = HoneyJar::factory()->create();

        $honeyjar_id = $honeyjar->id;

        // call the route to create a honey record
        $response = $this->actingAs($user)->post(route('inventoryHoney.record'), ['nb_jar' => 1, 'jar' => $honeyjar_id, 'user' => $user->id, 'other_person_checked' => false, 'other_person' => null, 'created_at' => null]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the honey record has been created in the database
        $this->assertDatabaseHas('honey_jar_user', [
            'honey_jar_id' => $honeyjar_id,
            'user_id' => $user->id,
            'nb_jar' => 1
        ]);
    }
}
