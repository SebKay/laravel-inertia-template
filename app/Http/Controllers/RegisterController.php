<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register\RegisterStore;
use App\Models\User;

class RegisterController extends Controller
{
    public function show()
    {
        $isProd = \app()->environment('production');

        return \inertia()->render('Register/Show', [
            'first_name' => ! $isProd ? 'Jim' : '',
            'last_name' => ! $isProd ? 'Gordon' : '',
            'email' => ! $isProd ? 'test@test.com' : '',
            'password' => ! $isProd ? '123456Ab#' : '',
        ]);
    }

    public function store(RegisterStore $request)
    {
        $user = new User($request->only('first_name', 'last_name', 'email'));

        $user->password = $request->validated('password');
        $user->save();

        \auth()->loginUsingId($user->id);

        return \redirect()->route('home');
    }
}
