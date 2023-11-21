<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;

describe('Users', function() {
    test('Can edit their accounts', function () {
        actingAs(User::factory()->create())
            ->get(route('account.edit'))
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Account/Edit')
            );
    });

    test('Can update their details', function () {
        $user = User::factory()->create([
            'first_name' => 'Jim',
            'last_name' => 'Gordon',
            'email' => 'jim@test.com',
            'password' => 'oldPassword#123',
        ]);

        expect(Hash::check('oldPassword#123', $user->password))->toBeTrue();

        expect($user)
            ->first_name->toBe('Jim')
            ->last_name->toBe('Gordon')
            ->email->toBe('jim@test.com');

        actingAs($user)
            ->patch(route('account.update'), [
                'first_name' => 'Tim',
                'last_name' => 'Drake',
                'email' => 'tim@test.com',
                'password' => 'newPassword#123',
            ])
            ->assertRedirect()
            ->assertSessionHas('message', 'Your account has been updated.');

        $user->refresh();

        expect($user)
            ->first_name->toBe('Tim')
            ->last_name->toBe('Drake')
            ->email->toBe('tim@test.com');

        expect(Hash::check('newPassword#123', $user->password))->toBeTrue();
    });
});

describe('Guests', function() {
    test("Can't edit accounts", function () {
        get(route('account.edit'))->assertRedirect(route('login'));
    });

    test("Can't update details", function () {
        patch(route('account.update'), [
            'name' => 'Tim Drake',
            'email' => 'tim@test.com',
        ])
            ->assertRedirect(route('login'));
    });
});
