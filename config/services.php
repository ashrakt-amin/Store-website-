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

    'currency' => [
        'key' => '3a504595f7f10b652a4e0ade7cd3b9d5',
    ],

    'paypal'=>[
        'mode'=> env('sandbox'),
        'client_id'=> env('ARPPoP2ozOYIE_laSFjXswsw3SkxQCr-fe0UH4OEwHFolMsvVv1Oxe59yTaT4PeN8THxg6rY6UJufLmv'),
        'secret'=> env('EMg5qnWWM-Uitb56jvCLG8MLPmolvtFo8QyEIrcRm4BSl531AvNHpvMs4UEpTW6BUTCLjrOjWqQmvWlN'),
    ],
    'moyasar'=>[
        'key' =>'pk_test_1Ss5SASTBHqqPsy5ZSKR54MreeXSRFtuX8h9XNRi',
        'secret'=>'sk_test_N7xjqjDdaN1xj9GjqeTKeXmjpAukBUgV89v2tKZz'
    ]
];
