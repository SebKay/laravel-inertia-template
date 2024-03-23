<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

describe('Users', function () {
    test('Can access the verification page', function () {
        actingAs(User::factory()->unverified()->create())
            ->get(route('verification.notice'))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('EmailVerification/Show')
            );
    });

    test('Can send the verificaiton notice', function () {
        Notification::fake();

        $user = User::factory()->unverified()->create();

        actingAs($user)
            ->post(route('verification.send'))
            ->assertRedirect();

        Notification::assertSentTo($user, Illuminate\Auth\Notifications\VerifyEmail::class);
    });
});

describe('Guests', function () {
    test("Can't access the verification page", function () {
        get(route('verification.notice'))
            ->assertRedirect(route('login'));
    });
});
