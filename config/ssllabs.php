<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SSL Labs API Endpoint
    |--------------------------------------------------------------------------
    |
    | ..
    */

    'endpoint' => env('SSLLABS_ENDPOINT', 'api.ssllabs.com'),

    'version' => env('SSLLABS_VERSION', 'v3'),

    /*
    |--------------------------------------------------------------------------
    | SSL Labs Quality Checker Email
    |--------------------------------------------------------------------------
    |
    | ..
    */

    'email' => env('SSLLABS_EMAIL', null),

    'send' => env('SSLLABS_SEND', false),

    /*
    |--------------------------------------------------------------------------
    | SSL Labs Quality Checker Schedule
    |--------------------------------------------------------------------------
    |
    | Supported: "yearly", "monthly", "weekly", "daily"
    */

    'schedule' => env('SSLLABS_SCHEDULE', 'weekly'),

    /*
    |--------------------------------------------------------------------------
    | SSL Labs Quality Checker Minimum Grade
    |--------------------------------------------------------------------------
    |
    | Supported: "A+", "A-", "A", "B", "C", "D", "E", "F", "T", "M"
    */

    'min_grade' => env('SSLLABS_MIN_GRADE', 'A+'),

];
