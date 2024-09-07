<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('an authenticated user cannot access the forgot password page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('password.request'))
        ->assertRedirect(route('dashboard'));
});

test('a guest user can access the forgot password page', function () {
    get(route('password.request'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Auth/ForgotPassword/Index')
            ->has('status', null)
        );
});

test('an email is required to request a reset password link', function () {
    post(route('password.email'))
        ->assertSessionHasErrors('email');
});

test('an email must be valid to request a reset password link', function () {
    post(route('password.email'), [
        'email' => 'invalid-email',
    ])
        ->assertSessionHasErrors('email');
});

test('a reset password link can be requested', function () {
    Notification::fake();

    $user = User::factory()->create();

    post(route('password.email'), [
        'email' => $user->email,
    ])
        ->assertRedirect()
        ->assertSessionHas('status', 'We have emailed your password reset link.');

    Notification::assertSentTo($user, ResetPassword::class);
});

test('an error is thrown if the reset password link cannot be sent', function () {
    Password::shouldReceive('sendResetLink')
        ->andReturn(Password::INVALID_USER);

    post(route('password.email'), [
        'email' => User::factory()->create()->email,
    ])
        ->assertSessionHasErrors('email');
});

test('an authenticated user cannot access the reset password page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get(route('password.reset', [
            'token' => 'token',
        ]))
        ->assertRedirect(route('dashboard'));
});

test('a guest user can access the reset password page', function () {
    get(route('password.reset', [
        'email' => 'test@example.com',
        'token' => 'token',
    ]))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Auth/ResetPassword/Index')
            ->has('email')
            ->where('email', 'test@example.com')
            ->has('token')
            ->where('token', 'token')
        );
});

test('an email is required to reset a password', function () {
    post(route('password.store', [
        'email' => '',
        'token' => 'token',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]))
        ->assertSessionHasErrors('email');
});

test('an email must be valid to reset a password', function () {
    post(route('password.store', [
        'email' => 'invalid-email',
        'token' => 'token',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]))
        ->assertSessionHasErrors('email');
});

test('a new password is required to reset a password', function () {
    $user = User::factory()->create();

    post(route('password.store', [
        'email' => $user->email,
        'token' => 'token',
        'password' => '',
        'password_confirmation' => 'new-password',
    ]))
        ->assertSessionHasErrors('password');
});

test('a new password must be confirmed to reset a password', function () {
    $user = User::factory()->create();

    post(route('password.store', [
        'email' => $user->email,
        'token' => 'token',
        'password' => 'new-password',
        'password_confirmation' => '',
    ]))
        ->assertSessionHasErrors('password');
});

test('a password can be reset with valid token', function () {
    Notification::fake();

    $user = User::factory()->create();

    post(route('password.store', [
        'email' => $user->email,
        'token' => Password::createToken($user),
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ]))
        ->assertRedirect(route('login'))
        ->assertSessionHas('status', 'Your password has been reset.');
});

test('an error is thrown if the password cannot be reset', function () {
    Password::shouldReceive('reset')
        ->andReturn(Password::INVALID_TOKEN);

    post(route('password.store'), [
        'email' => User::factory()->create()->email,
        'token' => 'invalid-token',
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ])
        ->assertSessionHasErrors('email');
});
