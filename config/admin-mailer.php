<?php

use Dimimo\AdminMailer\Http\Middleware\Authorize;

return [
    'prefix' => 'admin-mailer',
    'storage' => [
        'database' => [
            'connection' => env('DB_CONNECTION', 'mysql'),
        ]
    ],
    'gate' => [
        'admins' => ['dmostrey@yahoo.com', 'guido.belger@gmail.com']
    ],
    'middleware' => ['web',
        'auth',
        Authorize::class,
    ],
];