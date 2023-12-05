<?php

namespace App\Http\Controllers;

class EmailVerificationController extends Controller
{
    public function show()
    {
        return \inertia('EmailVerification/Show');
    }
}
