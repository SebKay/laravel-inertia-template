<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'layouts/inertia';

    public function share(Request $request): array
    {
        return \array_merge(parent::share($request), [
            'auth' => [
                'loggedIn' => \auth()->check(),
                'user' => $request->user() ? UserResource::make($request->user()) : [],
            ],
            'success' => $request->session()->get('success'),
            'error' => $request->session()->get('error'),
            'warning' => $request->session()->get('warning'),
        ]);
    }
}
