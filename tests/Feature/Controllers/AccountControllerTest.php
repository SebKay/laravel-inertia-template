<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;

describe('Users', function () {
    test('Can access the edit page', function () {
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
        $user = User::factory()->create([
            'first_name' => 'Jim',
            'last_name' => 'Gordon',
            'email' => 'jim@test.com',
            'password' => 'oldPassword#123',
        ]);

        actingAs($user)
            ->patch(route('account.update'), $newData = [
                'first_name' => 'Tim',
                'last_name' => 'Drake',
                'email' => 'tim@test.com',
                'password' => 'newPassword#123',
            ])
            ->assertRedirect()
            ->assertSessionHas('success', __('account.updated'));

        expect($user->refresh())
            ->first_name->toBe($newData['first_name'])
            ->last_name->toBe($newData['last_name'])
            ->email->toBe($newData['email']);

        expect(Hash::check($newData['password'], $user->password))->toBeTrue();
    });

    test("Can't update their email to one that already exists", function () {
        User::factory()->create([
            'email' => 'jim@test.com',
        ]);

        $user = User::factory()->create([
            'email' => 'jeff@test.com',
        ]);

        actingAs($user)
            ->patch(route('account.update'), $newData = [
                'email' => 'jim@test.com',
            ])
            ->assertSessionHasErrors('email');

        expect($user->refresh()->email)->not()->toBe($newData['email']);
    });
});

describe('Guests', function () {
    test("Can't access the edit page", function () {
        get(route('account.edit'))
            ->assertRedirectToRoute('login');
    });

    test("Can't update details", function () {
        patch(route('account.update'))
            ->assertRedirectToRoute('login');
    });
});
