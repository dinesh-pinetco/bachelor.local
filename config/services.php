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
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'webhook' => env('SLACK_WEBHOOK_URL'),
        'notification-channel' => env('SLACK_NOTIFICATION_CHANNEL', '#notification-channel'),
        'test-channel' => env('SLACK_TEST_CHANNEL', '#test-channel'),
        'log-channel' => env('SLACK_LOG_CHANNEL', '#log-channel'),
    ],

    'moodle' => [
        'base_url' => env('MOODLE_BASE_URL').'?wstoken='.env('MOODLE_WSTOKEN'),
        'test_view_url' => 'https://auswahltest.nordakademie.de/moodle/course/view.php',
        'wstoken' => env('MOODLE_WSTOKEN'),
        'types' => [
            'General Knowledge Questions' => [
                'course_id' => 14,
                'test_id' => 30,
            ],
            'School Grades' => [
                'course_id' => 15,
                'test_id' => 33,
            ],
            'Math test' => [
                'course_id' => 12,
                'test_id' => 21,
            ],
            'English test' => [
                'course_id' => 16,
                'test_id' => 35,
            ],
        ],
    ],

    'cubia' => [
        'base_url' => env('CUBIA_BASE_URL').'?customer='.env('CUBIA_CUSTOMER').'&ProjectID='.env('CUBIA_PROJECT_ID'),
        'customer' => env('CUBIA_CUSTOMER'),
        'project_id' => env('CUBIA_PROJECT_ID'),
    ],

    'meteor' => [
        'base_url' => env('METEOR_BASE_URL').'?p='.env('METEOR_P').'&s='.env('METEOR_S'),
        'p' => env('METEOR_P'),
        's' => env('METEOR_S'),
    ],

    'hubspot' => [
        'access_token' => env('HUBSPOT_ACCESS_TOKEN'),
        'required_scopes' => [
            'oauth',
            'crm.objects.contacts.read',
            'crm.objects.contacts.write',
            'crm.schemas.contacts.read',
            'crm.schemas.contacts.write',
        ],
    ],
    'nordakademie' => [
        'baseUrl' => env('NORDAKADEMIE_API_BASE_URL'),
        'key' => env('NORDAKADEMIE_API_KEY'),
        'items_per_page' => env('NORDAKADEMIE_ITEMS_PER_PAGE', 10),
    ],
];
