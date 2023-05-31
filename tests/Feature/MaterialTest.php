<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Material;
use App\Models\User;
use App\Models\InventoryPlace;

class MaterialTest extends TestCase
{
    
    // Test if material can be created acting as user and assert if the material has been created
    public function test_material_can_be_created()
    {
        $user = User::factory()->create();

        $place = InventoryPlace::factory()->create();

        // call the route to create a material
        $response = $this->actingAs($user)->post(route('inventoryMaterial.store'), ['name' => 'test', 'current_stock' => 1, 'max_stock' => 1, 'inventory_place_id' => $place->id]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the material has been created in the database
        $this->assertDatabaseHas('materials', [
            'name' => 'test',
            'current_stock' => 1,
            'max_stock' => 1,
            'inventory_place_id' => $place->id
        ]);
    }

    // Test if material can be modified acting as user and assert if the material has been modified
    public function test_material_can_be_modified()
    {
        $user = User::factory()->create();

        $material = Material::factory()->create();

        $material_id = $material->id;

        // call the route to modify a material
        $response = $this->actingAs($user)->put(route('inventoryMaterial.update', [$material_id]), ['name' => 'test', 'current_stock' => 1, 'max_stock' => 1, 'id' => $material_id, 'inventory_place_id' => $material->inventory_place_id]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the material has been modified in the database
        $this->assertDatabaseHas('materials', [
            'id' => $material_id,
            'name' => 'test',
            'current_stock' => 1,
            'max_stock' => 1
        ]);
    }

    // Test if material can be deleted acting as user and assert if the material has been deleted
    public function test_material_can_be_deleted()
    {
        $user = User::factory()->create();
        
        $material = Material::factory()->create();

        $material_id = $material->id;

        // call the route to delete a material
        $response = $this->actingAs($user)->delete(route('inventoryMaterial.destroy', [$material_id]));

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the material has been deleted in the database
        $this->assertDatabaseMissing('materials', [
            'id' => $material_id
        ]);
    }

    // Test if place can be created acting as user and assert if the place has been created
    public function test_place_can_be_created()
    {
        $user = User::factory()->create();

        // call the route to create a place
        $response = $this->actingAs($user)->post(route('inventoryPlace.store'), ['name' => 'test', 'address'=> 'test']);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the place has been created in the database
        $this->assertDatabaseHas('inventory_places', [
            'name' => 'test',
            'address' => 'test'
        ]);
    }

    // Test if place can be modified acting as user and assert if the place has been modified
    public function test_place_can_be_modified()
    {
        $user = User::factory()->create();

        $place = InventoryPlace::factory()->create();

        $place_id = $place->id;

        // call the route to modify a place
        $response = $this->actingAs($user)->put(route('inventoryPlace.update', [$place_id]), ['name' => 'test', 'address'=> 'test', 'id' => $place_id]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the place has been modified in the database
        $this->assertDatabaseHas('inventory_places', [
            'id' => $place_id,
            'name' => 'test',
            'address' => 'test'
        ]);
    }

    // Test if place can be deleted acting as user and assert if the place has been deleted
    public function test_place_can_be_deleted()
    {
        $user = User::factory()->create();
        
        $place = InventoryPlace::factory()->create();

        $place_id = $place->id;

        // call the route to delete a place
        $response = $this->actingAs($user)->delete(route('inventoryPlace.destroy', [$place_id]), ['id' => $place_id]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the place has been deleted in the database
        $this->assertDatabaseMissing('inventory_places', [
            'id' => $place_id
        ]);
    }

}
