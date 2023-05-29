<?php

namespace Tests\Feature;

use App\Models\Hive;
use App\Models\User;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InterventionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    //Test if the intervention material can be created
    public function test_intervention_material_can_be_created()
    {
        $user = User::factory()->create();

        $hive = Hive::factory()->create();

        //spatie permission
        SpatiePermission::create(['name' => 'manage hives']);

        //give the user the permission to manage hives
        $user->givePermissionTo('manage hives');

        //call the route updateMaterial on the hive
        
        $response = $this->actingAs($user)->put('/apiary/' . $hive->apiary_id . '/hive/' . $hive->id . '/updateMaterial', [
            'rise' => false,
            'nb_frames' => 10],
            [
                
                'apiary_id' => $hive->apiary_id,
                'hive_id' => $hive->id,
            ]
        );

        //dd the request sent to the route
        //dd($response);

        $response->assertStatus(302);

        $this->assertDatabaseHas('hives', [
            'id' => $hive->id,
            'rise' => false,
            'nb_frames' => 10,
        ]);

        //test if intervention material has been created
        $this->assertDatabaseHas('intervention_materials', [
            'new_rise' => false,	
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

        //call the route updateMaterial on the hive
        
        $response = $this->actingAs($user)->put('/apiary/' . $hive->apiary_id . '/hive/' . $hive->id . '/deactivateHive',
        [
            'hive_id' => $hive->id,
            'apiary_id' => $hive->apiary_id,
        ]);


        $response->assertStatus(302);

        $this->assertDatabaseHas('hives', [
            'id' => $hive->id,
            'is_active' => false,
        ]);

        //test if intervention queen type remove has been created
        $this->assertDatabaseHas('interventions', [
            'hive_id' => $hive->id,
            'type' => 'remove_queen',
        ]);
    }

    //Test if intervention queen type remove can be created
    public function test_intervention_queen_type_new_queen_can_be_created()
    {
        $user = User::factory()->create();

        $hive = Hive::factory()->inactive()->create();

        //assert

        //dd($hive);
        //spatie permission
        SpatiePermission::create(['name' => 'manage hives']);

        //give the user the permission to manage hives
        $user->givePermissionTo('manage hives');


        $response = $this->actingAs($user)->put('/apiary/' . $hive->apiary_id . '/hive/' . $hive->id . '/activateHive',
        [
            'date_queen' => '2021-01-01',
            'color_queen' => '#ff0000',
            'nb_frames' => 10,
            'rise' => true,
            'hive_id' => $hive->id,
            'apiary_id' => $hive->apiary_id,
        ]);


        $response->assertStatus(302);

        $this->assertDatabaseHas('hives', [
            'id' => $hive->id,
            'is_active' => true,
        ]);

        //test if intervention queen type remove has been created
        $this->assertDatabaseHas('interventions', [
            'hive_id' => $hive->id,
            'type' => 'new_queen',
        ]);
    }
}
