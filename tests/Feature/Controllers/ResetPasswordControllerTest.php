<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\from;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

test('The forgot password page can be accessed', function () {
    get(route('password'))
        ->assertOk()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('ResetPassword/Show')
        );
});

test('A password reset email can be sent', function () {
    Notification::fake();

    $user = User::factory()->create();

    post(route('password.store'), [
        'email' => $user->email,
    ])
        ->assertRedirect(route('login'));

    Notification::assertSentTo($user, ResetPassword::class);
});

test("A password reset email can't be requested with invalid credentials", function () {
    Notification::fake();

    from(route('password'))
        ->post(route('password.store'), [
            'email' => fake()->email(),
        ])
        ->assertsessionHasErrors('email')
        ->assertRedirect(route('password'));

    Notification::assertNothingSent();
});

test('The password reset page can be accessed', function () {
    $user = User::factory()->create();
    $token = Password::createToken($user);

    get(route('password.reset', [
        $token,
        'email' => $user->email,
    ]))
        ->assertOK()
        ->assertInertia(
            fn (Assert $page) => $page
                ->component('ResetPassword/Edit')
        );
});

test('Users can reset their passwords', function () {
    $user = User::factory()->create([
        'password' => fake()->password(6),
    ]);

    $token = Password::createToken($user);
    $newPassword = fake()->password(6);

    patch(route('password.update', [
        'token' => $token,
        'email' => $user->email,
        'password' => $newPassword,
        'password_confirmation' => $newPassword,
    ]))
        ->assertRedirect();
});
