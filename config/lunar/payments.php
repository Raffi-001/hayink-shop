<?php

return [

    'default' => env('PAYMENTS_TYPE', 'cash-in-hand'),

    'types' => [
        'cash-in-hand' => [
            'driver' => 'offline',
            'authorized' => 'payment-offline',
        ],
        'ameria-payment' => [
            'driver' => 'ameriabank',
            'authorized' => 'payment-received',
        ]
    ],

];
