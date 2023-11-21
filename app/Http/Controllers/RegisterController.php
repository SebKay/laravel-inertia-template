<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register\RegisterStore;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        return \inertia('Register/Show', \app()->environment('local') ? [
            'first_name' => 'Jim',
            'last_name' => 'Gordon',
            'email' => 'test@test.com',
            'password' => '123456Ab#',
            'organisation_name' => 'GCPD',
        ] : []);
    }

    public function store(RegisterStore $request)
    {
        $user = new User($request->only('first_name', 'last_name', 'email'));

        $user->password = $request->validated('password');
        $user->save();

        $user->organisations()->create([
            'name' => $request->validated('organisation_name'),
        ]);
        $user->currentOrganisation()->associate($user->organisations->first())->save();

        $user->assignRole('user');

        \auth()->loginUsingId($user->id);

        return \redirect()->route('home');
    }
}
