<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AmeriaBank VPOS Settings
    |--------------------------------------------------------------------------
    |
    | These values are pulled from your .env file.
    | Subdomain should be:
    |   - testpayments (for sandbox)
    |   - services (for production/live)
    |   - payments (another Ameria environment)
    |
    */

    'client_id' => env('AMERIABANK_CLIENT_ID'),

    'username' => env('AMERIABANK_USERNAME'),

    'password' => env('AMERIABANK_PASSWORD'),

    'subdomain' => env('AMERIABANK_SUBDOMAIN', 'testpayments'),

    /*
    |--------------------------------------------------------------------------
    | API Endpoints
    |--------------------------------------------------------------------------
    | Full endpoints are built dynamically based on the subdomain.
    | Example:
    |   https://testpayments.ameriabank.am/VPOS/api/VPOS/InitPayment
    */

    'endpoints' => [
        'init'     => '/VPOS/api/VPOS/InitPayment',
        'confirm'  => '/VPOS/api/VPOS/ConfirmPayment',
        'details'  => '/VPOS/api/VPOS/GetPaymentDetails',
        'refund'   => '/VPOS/api/VPOS/RefundPayment',
    ],

];
