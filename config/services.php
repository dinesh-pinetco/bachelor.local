<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'webhook'              => env('SLACK_WEBHOOK_URL'),
        'notification-channel' => env('SLACK_NOTIFICATION_CHANNEL', '#notification-channel'),
        'test-channel'         => env('SLACK_TEST_CHANNEL', '#test-channel'),
        'log-channel'          => env('SLACK_LOG_CHANNEL', '#log-channel'),
    ],

    'moodle' => [
        'base_url' => env('MOODLE_BASE_URL').'?wstoken='.env('MOODLE_WSTOKEN'),
        'wstoken'  => env('MOODLE_WSTOKEN'),
    ],

    'cubia' => [
        'base_url'   => env('CUBIA_BASE_URL').'?customer='.env('CUBIA_CUSTOMER').'&ProjectID='.env('CUBIA_PROJECT_ID'),
        'customer'   => env('CUBIA_CUSTOMER'),
        'project_id' => env('CUBIA_PROJECT_ID'),
    ],

    'meteor' => [
        'base_url' => env('METEOR_BASE_URL').'?p='.env('METEOR_P').'&s='.env('METEOR_S'),
        'p'        => env('METEOR_P'),
        's'        => env('METEOR_S'),
    ],

    'hubspot' => [
        'access_token'    => env('HUBSPOT_ACCESS_TOKEN'),
        'required_scopes' => [
            'oauth',
            'crm.objects.contacts.read',
            'crm.objects.contacts.write',
            'crm.schemas.contacts.read',
            'crm.schemas.contacts.write',
        ],
    ],
];
