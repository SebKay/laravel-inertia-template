<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\RegisterStore;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function show()
    {
        $isProd = App::environment('production');

        return Inertia::render('Register/Show', [
            'first_name' => !$isProd ? 'Jim' : '',
            'last_name'  => !$isProd ? 'Gordon' : '',
            'email'      => !$isProd ? 'test@test.com' : '',
            'password'   => !$isProd ? '123456Ab#' : '',
        ]);
    }

    public function store(RegisterStore $request)
    {
        $user = new User($request->only('first_name', 'last_name', 'email'));

        $user->password = $request->validated('password');
        $user->save();

        Auth::loginUsingId($user->id);

        return Redirect::route('home');
    }
}
