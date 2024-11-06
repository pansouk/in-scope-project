<?php

use App\Models\Role;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as Response;


beforeEach(function () {
    Role::factory()->admin()->create();
    Role::factory()->user()->create();
});

test('user can login good credentials', function () {
    $user = User::factory()->create();
    $response = $this->post('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['success', 'message', 'data']);
});

test('user can not login invalid credentials', function () {
    $response = $this->post('/api/login', [
        'email' => 'test@test.com',
        'password' => 'invalid-password',
    ]);
    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    $response->assertJsonStructure(['success', 'message', 'data']);
});

test('login with empty request', function () {
    $response = $this->post('/api/login', []);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});


