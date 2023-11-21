<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;

beforeEach(function () {
    $this->adminUser = User::factory()
        ->admin()
        ->create();

    $this->adminUser->organisations()->create([
        'name' => 'GCPD',
    ]);
    $this->adminUser->currentOrganisation()->associate($this->adminUser->organisations->first())->save();
});

describe('Admins', function () {
    test('Can see the edit page their organisation', function () {
        actingAs($this->adminUser)
            ->get(route('organisation.edit'))
            ->assertOk();
    });

    test('Can update their organisation name', function () {
        expect($this->adminUser->currentOrganisation->name)->toBe('GCPD');

        actingAs($this->adminUser)
            ->patch(route('organisation.update'), [
                'name' => 'New Name',
            ])
            ->assertRedirect();

        expect($this->adminUser->currentOrganisation->refresh()->name)->toBe('New Name');
    });
});

describe('Non-Admins', function () {
    test("Can't see the edit page their organisation", function () {
        $user = User::factory()->create();

        $user->organisations()->save($this->adminUser->currentOrganisation);
        $user->currentOrganisation()->associate($user->organisations->first())->save();

        actingAs($user)
            ->get(route('organisation.edit'))
            ->assertForbidden();
    });

    test("Can't update their organisation name", function () {
        $user = User::factory()->create();

        $user->organisations()->save($this->adminUser->currentOrganisation);
        $user->currentOrganisation()->associate($user->organisations->first())->save();

        expect($user->currentOrganisation->name)->toBe('GCPD');

        actingAs($user)
            ->patch(route('organisation.update'), [
                'name' => 'New Name',
            ])
            ->assertForbidden();

        expect($user->currentOrganisation->refresh()->name)->toBe('GCPD');
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
