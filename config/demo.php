<?php

return [
    'enabled' => (bool) env('DEMO_MODE', false),

    'features' => [
        'writes' => (bool) env('DEMO_ALLOW_WRITES', false),
        'billing' => (bool) env('DEMO_ALLOW_BILLING', false),
        'mail' => (bool) env('DEMO_ALLOW_MAIL', false),
        'uploads' => (bool) env('DEMO_ALLOW_UPLOADS', false),
    ],

    'reset' => [
        'enabled' => (bool) env('DEMO_RESET_ENABLED', false),
        'disk' => env('DEMO_RESET_DISK', 'digital_ocean'),
        'seeder' => env('DEMO_RESET_SEEDER', Database\Seeders\DemoSeeder::class),
        'wipe_stripe_customers' => (bool) env('DEMO_RESET_WIPE_STRIPE_CUSTOMERS', false),
        'allow_live_stripe_keys' => (bool) env('DEMO_RESET_ALLOW_LIVE_STRIPE_KEYS', false),
        'protected_disks' => [
            'local',
            'public',
            's3',
        ],
    ],
];
