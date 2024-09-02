<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('an authenticated user cannot access the registration page', function () {
    actingAs(User::factory()->create())
        ->get(route('register'))
        ->assertRedirect(route('dashboard'));
});

test('a guess user can access the registration page', function () {
    get(route('register'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Auth/Register/Index')
        );
});

test('a username is required to register', function () {
    post(route('register'), [
        'username' => '',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertSessionHasErrors('username');
});

test('an email is required to register', function () {
    post(route('register'), [
        'username' => 'test-user',
        'email' => '',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertSessionHasErrors('email');
});

test('a password is required to register', function () {
    post(route('register'), [
        'username' => 'test-user',
        'email' => 'test@example.com',
        'password' => '',
        'password_confirmation' => 'password',
    ])
        ->assertSessionHasErrors('password');
});

test('a password must be confirmed to register', function () {
    post(route('register'), [
        'username' => 'test-user',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => '',
    ])
        ->assertSessionHasErrors('password');
});

test('a password confirmation must match to register', function () {
    post(route('register'), [
        'username' => 'test-user',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'other-password',
    ])
        ->assertSessionHasErrors('password');
});

test('a username must be unique', function () {
    $existingUser = User::factory()->create([
        'username' => 'test-user',
    ]);

    post(route('register'), [
        'username' => $existingUser->username,
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertSessionHasErrors('username');
});

test('an email must be unique', function () {
    $existingUser = User::factory()->create([
        'email' => 'test@example.com',
    ]);

    post(route('register'), [
        'username' => 'test-user',
        'email' => $existingUser->email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertSessionHasErrors('email');
});

test('a new user can register', function () {
    $response = post(route('register'), [
        'username' => 'test-user',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertRedirect(route('dashboard'));

    expect($response)->hasSuccessMessage('Welcome aboard!');

    assertAuthenticated();
});
