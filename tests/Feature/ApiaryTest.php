<?php

namespace Tests\Feature;


use App\Models\Apiary;
use App\Models\User;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiaryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    //Test if the apiary page can be rendered
    public function test_apiary_page_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/apiary');

        $response->assertStatus(200);
    }

    //Test if the apiary can be created
    public function test_apiary_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/apiary', [
            'name' => 'test',
            'address' => 'test',
        ]);

        $response->assertStatus(302);
    }

    //Test if the apiary can be updated and assert if the apiary has been updated
    public function test_apiary_can_be_updated()
    {
        $user = User::factory()->create();

        SpatiePermission::create(['name' => 'manage apiaries']);

        //give the user the permission to manage apiaries
        $user->givePermissionTo('manage apiaries');

        $apiary = Apiary::factory()->create();

        $response = $this->actingAs($user)->put('/apiary/' . $apiary->id . '/updateApiary', [
            'name' => 'test',
            'address' => 'test',
        ]);

        // $this->assertDatabaseHas('apiaries', [
        //     'name' => 'test',
        //     'address' => 'test',
        // ]);

        $response->assertStatus(302);

    }

    //Test if the apiary can be deleted
    public function test_apiary_can_be_deleted()
    {
        $user = User::factory()->create();

        SpatiePermission::create(['name' => 'manage apiaries']);

        //give the user the permission to manage apiaries
        $user->givePermissionTo('manage apiaries');

        $apiary = Apiary::factory()->create();

        $response = $this->actingAs($user)->delete('/apiary/' . $apiary->id);

        
        $response->assertStatus(302);
        //check if the apiary has been deleted
        $this->assertDatabaseMissing('apiaries', ['id' => $apiary->id]);

    }


}
