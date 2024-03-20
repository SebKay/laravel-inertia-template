<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;

beforeEach(function () {
    $this->adminUser = User::factory()
        ->admin('admin@test.com')
        ->create();

    $this->adminUser->organisations()->create([
        'name' => 'GCPD',
    ]);

    $this->adminUser->organisation()->associate($this->adminUser->organisations->first())->save();
});

describe('Admins', function () {
    test('Can see the edit page for their current organisation', function () {
        actingAs($this->adminUser)
            ->get(route('organisation.edit'))
            ->assertOk();
    });

    test("Can update their organisation's name", function () {
        expect($this->adminUser->organisation->name)->toBe('GCPD');

        actingAs($this->adminUser)
            ->patch(route('organisation.update'), [
                'name' => 'New Name',
            ])
            ->assertRedirect();

        expect($this->adminUser->organisation->refresh()->name)->toBe('New Name');
    });
});

describe('Non-Admins', function () {
    test("Can't see the edit page for their organisation", function () {
        $user = User::factory()->create();

        $user->organisations()->save($this->adminUser->organisation);
        $user->organisation()->associate($user->organisations->first())->save();

        actingAs($user)
            ->get(route('organisation.edit'))
            ->assertForbidden();
    });

    test("Can't update their organisation's name", function () {
        $user = User::factory()->create();

        $user->organisations()->save($this->adminUser->organisation);
        $user->organisation()->associate($user->organisations->first())->save();

        expect($user->organisation->name)->toBe('GCPD');

        actingAs($user)
            ->patch(route('organisation.update'), [
                'name' => 'New Name',
            ])
            ->assertForbidden();

        expect($user->organisation->refresh()->name)->toBe('GCPD');
    });
});

describe('Guests', function () {
    test("Can't see the edit page of organisations", function () {
        get(route('organisation.edit'))
            ->assertRedirect();
    });

    test("Can't update organisations", function () {
        patch(route('organisation.edit'))
            ->assertRedirect();
    });
});
