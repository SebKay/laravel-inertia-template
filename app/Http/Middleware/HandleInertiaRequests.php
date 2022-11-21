<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    public function share(Request $request): array
    {
        $isLoggedIn = Auth::check();
        $user       = $isLoggedIn ? UserResource::make(User::find(Auth::id())) : [];

        return array_merge(parent::share($request), [
            'auth' => [
                'isLoggedIn' => $isLoggedIn,
                'user'       => $user,
            ],
            'notice' => $request->session()->get('notice') ?: [
                'type'    => '',
                'message' => '',
            ],
        ]);
    }
}
