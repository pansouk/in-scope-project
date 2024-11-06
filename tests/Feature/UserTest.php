<?php

use App\Models\Role;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as Response;

beforeEach(function () {
    Role::factory()->admin()->create();
    Role::factory()->user()->create();
    $this->admin = User::factory()->admin()->create();
    User::factory(20)->user()->create();
});

test('users-index-unauthorized', function () {
    $response = $this->getJson('/api/users');
    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});

test('users-index-all', function () {
    $response = $this->actingAs($this->admin)
        ->withSession(['banned' => true])
        ->getJson('/api/users');
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['success', 'message', 'data']);
});

test('users-index-admins', function () {
    $response = $this->actingAs($this->admin)
        ->withSession(['banned' => true])
        ->getJson('/api/users/admin');
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['success', 'message', 'data']);
});

test('users-index-users', function () {
    $response = $this->actingAs($this->admin)
        ->withSession(['banned' => true])
        ->getJson('/api/users/admin');
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['success', 'message', 'data']);
});

test('user-create', function(){
    $user_role = Role::where('name', 'user')->first();
    $response = $this->actingAs($this->admin)
        ->withSession(['banned' => true])
        ->json('POST', '/api/users/create',
            [
                'name' => 'test name',
                'email' => 'test@test.com',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role_id' => $user_role->id,
                'remember_token' => Str::random(10),
            ]);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonStructure(['success', 'message', 'data']);
});

test('user-create-validation', function(){
    $user_role = Role::where('name', 'user')->first();
    $response = $this->actingAs($this->admin)
        ->withSession(['banned' => true])
        ->json('POST', '/api/users/create',
            [
                'name' => '',
                'email' => '',
                'password' => '',
                'role_id' => $user_role->id,
                'remember_token' => Str::random(10),
            ]);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonStructure(['success', 'errors']);
});
