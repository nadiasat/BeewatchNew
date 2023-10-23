<?php

namespace Tests\Feature;

use App\Models\Hive;
use App\Models\User;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\RiskyTestError;
use Tests\TestCase;

class InterventionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    // Test if the intervention material can be created
    public function test_intervention_material_can_be_created()
    {
        $user = User::factory()->create();

        $hive = Hive::factory()->create();

        // spatie permission
        SpatiePermission::create(['name' => 'manage hives']);

        // give the user the permission to manage hives
        $user->givePermissionTo('manage hives');

        $apiary_id = $hive->apiary_id;
        $hive_id = $hive->id;
       
        // call test method on the route updateMaterial with parameters in the uri and new rise and nb_frames
        $response = $this->actingAs($user)->put(route('hive.updateMaterial', [$hive_id, $apiary_id]), ['rise' => true, 'nb_frames' => 10]);

        // assert response status
        $response->assertStatus(302);
        
        // assert if hive has been updated
        $this->assertDatabaseHas('hives', [
            'id' => $hive->id,
            'rise' => 1,
            'nb_frames' => 10,
        ]);

        // call test method on the route store with parameters in the uri and new rise and nb_frames
        $response = $this->actingAs($user)->get(route('interventionMaterial.store', ['new_nb_frames' => 10,'new_rise' => true,'hive_id' => $hive_id]));

        // assert response status
        $response->assertStatus(302);

        //test if intervention has been created
        $this->assertDatabaseHas('interventions', [
            'hive_id' => $hive_id,
            'type' => 'material',
        ]);

        //test if intervention material has been created
        $this->assertDatabaseHas('intervention_materials', [
            'new_rise' => 1,	
            'new_nb_frames' => 10,
        ]);


    }

    //Test if intervention queen type remove can be created
    public function test_intervention_queen_type_remove_can_be_created()
    {
        $user = User::factory()->create();

        $hive = Hive::factory()->create();

        //assert

        //dd($hive);
        //spatie permission
        SpatiePermission::create(['name' => 'manage hives']);

        //give the user the permission to manage hives
        $user->givePermissionTo('manage hives');

        $apiary_id = $hive->apiary_id;
        $hive_id = $hive->id;

        //call the route hive.deactivateHive on the hive
        $response = $this->actingAs($user)->put(route('hive.deactivateHive', [$hive_id, $apiary_id]));

        //assert response status
        $response->assertStatus(302);

        //assert if hive has been updated
        $this->assertDatabaseHas('hives', [
            'id' => $hive_id,
            'is_active' => false,
        ]);

        //call the route interventionQueen.deactivate
        $response = $this->actingAs($user)->get(route('interventionQueen.deactivate', ['hive_id' => $hive_id]));

        //test if intervention queen type remove has been created
        $this->assertDatabaseHas('interventions', [
            'hive_id' => $hive_id,
            'type' => 'remove_queen',
        ]);
    }

    // //Test if intervention queen type remove can be created
    public function test_intervention_queen_type_new_queen_can_be_created()
    {
        $user = User::factory()->create();

        $hive = Hive::factory()->inactive()->create();

        //spatie permission
        SpatiePermission::create(['name' => 'manage hives']);

        //give the user the permission to manage hives
        $user->givePermissionTo('manage hives');

        $apiary_id = $hive->apiary_id;
        $hive_id = $hive->id;

        //call the route hive.activateHive on the hive
        $response = $this->actingAs($user)->put(route('hive.activateHive', [$hive_id, $apiary_id]), ['date_queen' => '2021-01-01', 'color_queen' => '#ff0000','nb_frames' => 10, 'rise' => true,]);

        //assert response status
        $response->assertStatus(302);

        //assert if hive has been updated
        $this->assertDatabaseHas('hives', [
            'id' => $hive_id,
            'is_active' => true,
        ]);

        //call the route interventionQueen.store
        $response = $this->actingAs($user)->get(route('interventionQueen.store', ['date_queen' => '2021-01-01', 'color_queen' => '#ff0000','nb_frames' => 10, 'rise' => true, 'hive_id' => $hive_id]));
        
        //test if intervention queen type remove has been created
        $this->assertDatabaseHas('interventions', [
            'hive_id' => $hive_id,
            'type' => 'new_queen',
        ]);
    }

    // Test if intervention control can be created
    public function test_intervention_control_can_be_created(){

        $user = User::factory()->create();

        $hive = Hive::factory()->inactive()->create();

        //spatie permission
        SpatiePermission::create(['name' => 'manage hives']);

        //give the user the permission to manage hives
        $user->givePermissionTo('manage hives');

        $hive_id = $hive->id;

        //call the route interventionControl.store
        $response = $this->actingAs($user)->post(route('interventionControl.store', 
        [
            'hive_id' => $hive_id,
            'glimpse_queen' => true,
            'queen_laid' => false,
            'brood' => false,
            'frames_full' => true,
            'honey' => null,
            'honey_rise' => true,
            'sealed_honey' => false,
            'male_cells' => true,
            'eliminate_queen_cells' => false,
            'clean_plate' => true,
            'nb_varroa' => 12,
            'comment' => 'test'
        ]));

        //assert response status
        $response->assertStatus(302);

        // assert if intervention has been created
        $this->assertDatabaseHas('interventions', [
            'hive_id' => $hive_id,
            'type' => 'control',
        ]);

        // assert if intervention control has been created
        $this->assertDatabaseHas('intervention_controls', [
            'glimpse_queen' => true,
            'queen_laid' => false,
            'brood' => false,
            'frames_full' => true,
            'honey' => null,
            'honey_rise' => true,
            'sealed_honey' => false,
            'male_cells' => true,
            'eliminate_queen_cells' => false,
            'clean_plate' => true,
            'nb_varroa' => 12,
            'comment' => 'test'
        ]);
            
    }

}
