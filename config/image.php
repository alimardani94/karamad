<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',


    'thumbs' => [
        'products' => [
            'small' => ['prefix' => 's_', 'width' => 256, 'height' => 256,],
            'medium' => ['prefix' => 'm_', 'width' => 512, 'height' => 512,],
        ],
        'courses' => [
            'small' => ['prefix' => 's_', 'width' => 250, 'height' => 400,],
            'medium' => ['prefix' => 'm_', 'width' => 250, 'height' => 400,],
        ],
    ],

];
