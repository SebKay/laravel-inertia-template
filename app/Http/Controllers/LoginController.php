<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        $isProd = App::environment('production');

        return Inertia::render('Login/Show', [
            'email'    => !$isProd ? \env('SEED_ADMIN_EMAIL') : '',
            'password' => !$isProd ? '12345' : '',
            'remember' => !$isProd ? true : false,
            'redirect' => $request->query('redirect', ''),
        ]);
    }

    public function store(LoginStore $request)
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->validated('remember'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $request->session()->regenerate();

        if ($request->validated('redirect')) {
            return Redirect::to($request->validated('redirect'));
        }

        return Redirect::route('home');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('login');
    }
}
