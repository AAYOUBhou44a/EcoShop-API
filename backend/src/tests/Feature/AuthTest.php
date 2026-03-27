<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class AuthTest extends TestCase
{
    use RefreshDatabase;

   
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Abde',
            'email' => 'abde@test.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                     'token'
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'abde@test.com'
        ]);
    }

    
    public function test_user_can_login()
    {
        
        $user = User::factory()->create([
            'email' => 'abde@test.com',
            'password' => bcrypt('123456')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'abde@test.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
                     'token'
                 ]);
    }

    
    public function test_user_can_get_profile_using_token()
    {
        
        $user = User::factory()->create([
            'email' => 'abde@test.com',
            'password' => bcrypt('123456')
        ]);

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->getJson('/api/me');

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $user->id,
                     'email' => $user->email,
                     'name' => $user->name,
                 ]);
    }
}