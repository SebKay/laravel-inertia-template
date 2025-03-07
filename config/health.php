<?php

return [
    'notifications' => [
        'throttle_notifications_for_minutes' => 60,

        'mail' => [
            'to' => env('HEALTH_CHECK_TO_ADDRESS', ''),
        ],
    ],
];
