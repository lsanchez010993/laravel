<?php

use Illuminate\Support\Str;

return [



    'driver' => env('SESSION_DRIVER', 'database'),
    'lifetime' => (int) env('SESSION_LIFETIME', 120),
    'expire_on_close' => false,
    'encrypt' => env('SESSION_ENCRYPT', false),
    'files' => storage_path('framework/sessions'),
    'connection' => env('SESSION_CONNECTION',null),
    'table' => env('SESSION_TABLE', 'sessions'),
    'store' => env('SESSION_STORE'),
    'lottery' => [2, 100],
    'cookie' => env('SESSION_COOKIE', 'laravel_session'),

    'path' => env('SESSION_PATH', '/'),
    'domain' => env('SESSION_DOMAIN',null),
    'secure' => env('SESSION_SECURE_COOKIE',false),
    'http_only' =>  true,
    'same_site' => 'lax',
    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
