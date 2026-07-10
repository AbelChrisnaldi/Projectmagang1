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

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'telkom_sso' => [
        'enabled' => env('TELU_SSO_ENABLED', false),
        'app_name' => env('TELU_SSO_APP_NAME', 'Web Industrial Engineering and Business Innovation (IEBI)'),
        'app_key' => env('TELU_SSO_APP_KEY', ''),
        'auth_url' => env('TELU_SSO_AUTH_URL', 'https://auth-v2.telkomuniversity.ac.id/api/oauth/issueauth-app'),
        'profile_url' => env('TELU_SSO_PROFILE_URL', 'https://auth-v2.telkomuniversity.ac.id/api/oauth/issueprofile-app'),
        'origin' => env('TELU_SSO_ORIGIN', 'https://iebi.rg.telkomuniversity.ac.id/'),
        'timeout' => (int) env('TELU_SSO_TIMEOUT', 10),
        'connect_timeout' => (int) env('TELU_SSO_CONNECT_TIMEOUT', 5),
        'local_fallback' => env('TELU_SSO_LOCAL_FALLBACK', true),
    ],

];
