<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\withoutExceptionHandling;
use function Pest\Laravel\withoutMiddleware;

describe('Users', function () {
    test('Can access the verification page', function () {
        actingAs(User::factory()->unverified()->create())
            ->get(route('verification.notice'))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('EmailVerification/Show')
            );
    });

    test('Can verify their email address', function () {
        withoutExceptionHandling();

        $user = User::factory()->unverified()->create();

        expect($user->verified_at)->toBeNull();

        actingAs($user)
            ->withoutMiddleware(Illuminate\Routing\Middleware\ValidateSignature::class)
            ->get(route('verification.verify', [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ]))
            ->assertRedirect(route('home'));

        expect($user->refresh()->email_verified_at)->not()->toBeNull();
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
