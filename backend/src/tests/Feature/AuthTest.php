<?php

use App\Models\User;

it('registers a user', function () {
    $response = $this->postJson('/api/v1/auth/register', [
        'name' => 'Alice',
        'email' => 'alice@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertCreated()->assertJsonStructure(['token', 'user' => ['id', 'email']]);
});

it('logs in a user', function () {
    User::factory()->create(['email' => 'bob@example.com', 'password' => 'password123']);

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => 'bob@example.com',
        'password' => 'password123',
    ]);

    $response->assertOk()->assertJsonStructure(['token']);
});

it('blocks guest from protected route', function () {
    $this->getJson('/api/v1/auth/me')->assertUnauthorized();
});
