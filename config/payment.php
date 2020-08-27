<?php

return [
    'gateways' => [
        'zarinpal' => [
            'wsdl' => env('ZARINPAL_WSDL', 'https://www.zarinpal.com/pg/services/WebGate/wsdl'),
            'merchantID' => env('ZARINPAL_MERCHANT_ID'),
        ],

        'mellat' => [
            'terminalId' => env('MELLAT_TERMINAL_ID'),
            'username' => env('MELLAT_USERNAME'),
            'password' => env('MELLAT_PASSWORD'),
            'payerId' => env('MELLAT_PAYER_ID', 0),
            'wsdl' => 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl',
            'url' => 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat',
        ],
    ],
];
