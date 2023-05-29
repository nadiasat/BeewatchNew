<?php

namespace Tests\Feature;

use App\Models\Hive;
use App\Models\Apiary;
use App\Models\User;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HiveTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    use RefreshDatabase;



    //Test if the hive page can be rendered acting as user
    public function test_hive_page_can_be_rendered()
    {
        $user = User::factory()->create();

        $apiary = Apiary::factory()->create();

        $apiary->users()->attach($user);

        $response = $this->actingAs($user)->get('/apiary/' . $apiary->id . '/hive');

        $response->assertStatus(200);
    }

    //Test if the hive can be created acting as user and assert if the hive has been created
    public function test_hive_can_be_created()
    {
        $user = User::factory()->create();

        $apiary = Apiary::factory()->create();

        $apiary->users()->attach($user);

        //spatie permission
        SpatiePermission::create(['name' => 'manage hives']);

        //give the user the permission to manage hives
        $user->givePermissionTo('manage hives');


        $apiary_id = $apiary->id;

        $response = $this->actingAs($user)->post('/hive', [
            'name' => 'test',
            'date_queen' => '2021-01-01',
            'color_queen' => '#ff0000',
            'rise' => true,
            'nb_frames' => 1,
            'nb_varroa' => 1,
            'is_active' => true,
            'apiary' => $apiary_id,
        ]);

        $response->assertStatus(302);

        //assert if the hive has been created
        $this->assertDatabaseHas('hives', [
            'name' => 'test',
            'date_queen' => '2021-01-01',
            'color_queen' => '#ff0000',
            'rise' => true,
            'nb_frames' => 1,
            'nb_varroa' => 1,
            'is_active' => true,
            'apiary_id' => $apiary_id,
        ]);

    }

    //Test if the hive can be deleted
    // public function test_hive_can_be_deleted()
    // {
    //     $user = User::factory()->create();

    //     //$apiary = Apiary::factory()->create();

    //     $hive = Hive::factory()->create();

    //     //spatie permission
    //     SpatiePermission::create(['name' => 'manage hives']);

    //     //give the user the permission to manage hives
    //     $user->givePermissionTo('manage hives');

        
    //     //delete the hive and pass apiary as parameter
    //     $response = $this->actingAs($user)->delete('apiary/'. $hive->apiary_id .  '/hive/' . $hive->id, 
    //     [
    //         'hive' => $hive->id,
    //         'apiary' => $hive->apiary_id,
    //     ]);


    //     $response->assertStatus(302);


    //     //assert database has not the hive
    //     $this->assertDatabaseMissing('hives', [
    //         'id' => $hive->id,
    //     ]);


    // }


}
