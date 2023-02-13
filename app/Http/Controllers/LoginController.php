<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginStore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show(Request $request)
    {
        $isProd = \app()->environment('production');

        return \inertia()->render('Login/Show', [
            'email'    => !$isProd ? \env('SEED_ADMIN_EMAIL') : '',
            'password' => !$isProd ? '12345' : '',
            'remember' => !$isProd ? true : false,
            'redirect' => $request->query('redirect', ''),
        ]);
    }

    public function store(LoginStore $request)
    {
        \throw_if(
            !\auth()->attempt($request->only('email', 'password'), $request->validated('remember')),
            ValidationException::withMessages([
                'email' => \__('auth.failed'),
            ])
        );

        $request->session()->regenerate();

        if ($request->validated('redirect')) {
            return \redirect()->to($request->validated('redirect'));
        }

        return \redirect()->route('home');
    }

    public function destroy(Request $request)
    {
        \auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return \redirect()->route('login');
    }
}
