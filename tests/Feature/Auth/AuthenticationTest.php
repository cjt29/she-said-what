<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('an authenticated user cannot access the login page', function () {
    actingAs(User::factory()->create())
        ->get(route('login'))
        ->assertRedirect(route('dashboard'));
});

test('a guest user can access the login page', function () {
    get(route('login'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Auth/Login/Index')
        );
});

test('an email is required to log in', function () {
    post(route('login'), [
        'email' => '',
        'password' => 'password',
    ])
        ->assertSessionHasErrors('email');
});

test('a password is required to log in', function () {
    $user = User::factory()->create();
    post(route('login'), [
        'email' => $user->email,
        'password' => '',
    ])
        ->assertSessionHasErrors('password');
});

test('an existing user can log in', function () {
    $user = User::factory()->create();

    post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertRedirect(route('dashboard'));

    assertAuthenticated();
});

test('an existing user cannot log in with an invalid password', function () {
    $user = User::factory()->create();

    post(route('login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ])
        ->assertSessionHasErrors('email');

    assertGuest();
});

test('a guest user cannot log out', function () {
    post(route('logout'))
        ->assertRedirect(route('login'));
});

test('an authenticated user can log out', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('home'));

    assertGuest();
});
