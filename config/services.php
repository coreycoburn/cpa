<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'nexmo' => [
        'key' => env('NEXMO_KEY'),
        'secret' => env('NEXMO_SECRET'),
        'sms_from' => '14707880950',
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'authorizenet' => [
        'id' => env('AUTHORIZE_NET_API_LOGIN_ID'),
        'transaction' => env('AUTHORIZE_NET_TRANSACTION_KEY'),
        'key' => env('AUTHORIZE_NET_KEY'),
        'acceptjs' => env('AUTHORIZE_NET_ACCEPT_JS'),
    ],

    'google' => [
        'places' => [
            'uri' => env('GOOGLE_PLACES_URI'),
            'key' => env('GOOGLE_PLACES_KEY')
        ]
    ]
];
