<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return \inertia('EmailVerification/Show');
    }

    public function store(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return \redirect()->route('home');
    }
}
