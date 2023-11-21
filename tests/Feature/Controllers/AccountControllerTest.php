<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;

describe('Users', function() {
    test('Can edit their accounts', function () {
        $user = User::factory()->create();

        actingAs($user)
            ->get(route('account.edit'))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Account/Edit')
                    ->has('user')
                    ->where('user.first_name', $user->first_name)
                    ->where('user.last_name', $user->last_name)
                    ->where('user.email', $user->email)
            );
    });

    test('Can update their details', function () {
        $user = User::factory()->create($oldData = [
            'first_name' => 'Jim',
            'last_name' => 'Gordon',
            'email' => 'jim@test.com',
            'password' => 'oldPassword#123',
        ]);

        expect($user)
            ->first_name->toBe($oldData['first_name'])
            ->last_name->toBe($oldData['last_name'])
            ->email->toBe($oldData['email']);

        expect(Hash::check($oldData['password'], $user->password))->toBeTrue();

        actingAs($user)
            ->patch(route('account.update'), $newData = [
            'first_name' => 'Tim',
            'last_name' => 'Drake',
            'email' => 'tim@test.com',
            'password' => 'newPassword#123',
        ])
            ->assertRedirect()
            ->assertSessionHas('message', __('account.updated'));

        expect($user->refresh())
            ->first_name->toBe($newData['first_name'])
            ->last_name->toBe($newData['last_name'])
            ->email->toBe($newData['email']);

        expect(Hash::check($newData['password'], $user->password))->toBeTrue();
    });
});

describe('Guests', function() {
    test("Can't edit accounts", function () {
        get(route('account.edit'))
            ->assertRedirect(route('login'));
    });

    test("Can't update details", function () {
        patch(route('account.update'))
            ->assertRedirect(route('login'));
    });
});
