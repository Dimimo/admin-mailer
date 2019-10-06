<?php

use Dimimo\AdminMailer\Http\Middleware\Authorize;

return [
    'prefix' => 'admin-mailer',
    'storage' => [
        'database' => ['connection' => env('DB_CONNECTION', 'mysql')],
    ],
    'gate' => [
        /*
         * These are the emails of administrators in the USER database
         */
        'admins' => ['dmostrey@yahoo.com', 'guido.belger@gmail.com']
    ],
    /*
     * This is the link to the logo, it CAN'T be an existing image
     * This link is needed for tracking and response with 'logo_image'
     * THIS PICTURE MAY NOT PHYSICALLY EXIST ON THE SERVER
     * If not, the server image is shown and there will be no tracking
     */
    'logo_link' => 'img/logo10.png',
    /*
     * This is the link to the logo, it SHOULD be an existing image
     * This picture is replied by the tracking script
     */
    'logo_image' => 'img/mail-logo.png',
    'middleware' => [
        'web',
        'auth',
        Authorize::class,
    ],
    'email' => [
        'from' => [
            'address' => 'contact@puertoparrot.com',
            'name' => 'Puerto Parrot',
            ],
        'reply_to' => [
            'address' => 'contact@puertoparrot.com',
            'name' => 'Puerto Parrot',
        ],
        /*
         * The delay (in milliseconds) is included in running the mass email script
         * Some services like Amazon SES has a limit per minute
         */
        'delay' => 50,
        /*
         * The replace tags MUST come from the mailer_customers table
         * IF a field is empty, the first [0] value is returned instead
         * For example, if realname is unknown, the name field value is returned
         */
        'replacements' => [
            'search' => ['**name**', '**realname**', '**email**',],
            'replace' => ['name', 'realname', 'email'],
        ],
    ]
];
