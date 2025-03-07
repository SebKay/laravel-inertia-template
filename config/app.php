<?php

use App\Enums\Environment;

return [

    'seed' => [
        'users' => [
            'super' => [
                'email' => env('SEED_SUPER_ADMIN_EMAIL', 'super@laravel-inertia-template.test'),
                'password' => env('SEED_SUPER_ADMIN_PASSWORD', '12345'),
            ],
            'admin' => [
                'email' => env('SEED_ADMIN_EMAIL', 'admin@laravel-inertia-template.test'),
                'password' => env('SEED_ADMIN_PASSWORD', '12345'),
            ],
            'user' => [
                'email' => env('SEED_USER_EMAIL', 'user@laravel-inertia-template.test'),
                'password' => env('SEED_USER_PASSWORD', '12345'),
            ],
        ],
    ],

    'env' => env('APP_ENV', Environment::PRODUCTION->value),
];
