<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Apiary;
use Spatie\Permission\Models\Permission as SpatiePermission;

class UserTest extends TestCase
{
    
    // Test if user can be created acting as user and assert if the user has been created
    public function test_user_can_be_created()
    {
        $superadmin = User::factory()->create();

        // spatie permission manage users
        SpatiePermission::create(['name' => 'manage users']);

        // give the user the permission to manage users
        $superadmin->givePermissionTo('manage users');

        // call the route to create a user
        $response = $this->actingAs($superadmin)->post(route('users.store'), ['firstname' => 'test', 'lastname'=>'test', 'email' => 'test@test.com']);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the user has been created in the database
        $this->assertDatabaseHas('users', [
            'firstname' => 'test',
            'lastname' => 'test',
            'email' => 'test@test.com',
        ]);
    }

    // Test if user can be modified acting as user and assert if the user has been modified
    public function test_user_can_be_modified()
    {
        $superadmin = User::factory()->create();

        $apiary1 = Apiary::factory()->create();
        $apiary2 = Apiary::factory()->create();

        // give the user the permission to manage users
        $superadmin->givePermissionTo('manage users');

        $user = User::factory()->create();

        $user->apiaries()->attach($apiary1->id);
        $user->apiaries()->attach($apiary2->id);

        $user_id = $user->id;

        // call the route to modify a user
        $response = $this->actingAs($superadmin)->put(route('users.update', [$user_id]), ['apiaries'=> [$apiary1, $apiary2], 'user' => $user]);

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the user has been modified in the database
        $this->assertDatabaseHas('apiary_user', [
            'user_id' => $user_id,
            'apiary_id' => $apiary1->id
        ]);

        $this->assertDatabaseHas('apiary_user', [
            'user_id' => $user_id,
            'apiary_id' => $apiary2->id
        ]);
    }


    // Test if user can be deleted acting as user and assert if the user has been deleted
    public function test_user_can_be_deleted()
    {
        $superadmin = User::factory()->create();

        // give the user the permission to manage users
        $superadmin->givePermissionTo('manage users');

        $user = User::factory()->create();

        $user_id = $user->id;

        // call the route to delete a user
        $response = $this->actingAs($superadmin)->delete(route('users.destroy', [$user_id]));

        // assert that the response is a redirect
        $response->assertStatus(302);

        // assert that the user has been deleted in the database
        $this->assertDatabaseMissing('users', [
            'id' => $user_id,
        ]);
    }
    
    

}
