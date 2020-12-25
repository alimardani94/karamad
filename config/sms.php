<?php

return [
    'driver' => env('SMS_DRIVER', 'payam_resan'),

    'drivers' => [
        'candoo' => [
            'wdsl' => env('SMS_CANDOO_WDSL', 'http://my.candoosms.com/services/?wsdl'),
            'username' => env('SMS_CANDOO_USERNAME'),
            'password' => env('SMS_CANDOO_PASSWORD'),
            'source' => env('SMS_CANDOO_SOURCE'),
            'flash' => env('SMS_CANDOO_FLASH', '0'),
        ],
        'payam_resan' => [
            'wdsl' => env('SMS_PAYAM_RESAN_WDSL', 'https://www.payam-resan.com/ws/v2/ws.asmx?wsdl'),
            'username' => env('SMS_PAYAM_RESAN_USERNAME'),
            'password' => env('SMS_PAYAM_RESAN_PASSWORD'),
            'source' => env('SMS_PAYAM_RESAN_SOURCE'),
        ],
    ],
];
