<?php
return [

    'default' => env('MAIL_MAILER', 'smtp'),

   'mailers' => [
    'smtp' => [
        'transport' => 'smtp',
        'host' => env('MAIL_HOST', 'mailsrv2.dondominio.com'),
        'port' => env('MAIL_PORT', 587),
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'username' => env('MAIL_USERNAME', 'admin@luissanchez.cat'),
        'password' => env('MAIL_PASSWORD'),
        'timeout' => null,
        'local_domain' => env('MAIL_EHLO_DOMAIN'),
        'stream' => [
            'ssl' => [
                'allow_self_signed' => true,
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ],
    ],

    'log' => [
        'transport' => 'log',
        'channel' => env('MAIL_LOG_CHANNEL'),
    ],
    // Otros mailers...



        // Otros mailers (log, array, etc.)
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'l.sanchez4@sapalomera.cat'),
        'name' => env('MAIL_FROM_NAME', 'Tu Aplicación'),
    ],
];
