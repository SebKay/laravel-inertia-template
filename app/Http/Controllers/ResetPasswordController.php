<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPassword\ResetPasswordStore;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function show(Request $request)
    {
        return \inertia('ResetPassword/Show');
    }

    public function store(ResetPasswordStore $request)
    {
        \session()->flash('message', \__('passwords.sent'));

        return \redirect()->route('login');
    }
}
