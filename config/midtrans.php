<?php
return [
    'product' => [
        'server_key'    => env('MIDTRANS_PRODUCT_SERVER_KEY'),
        'client_key'    => env('MIDTRANS_PRODUCT_CLIENT_KEY'),
        'is_production' => env('MIDTRANS_PRODUCT_IS_PRODUCTION') === 'true',
        'is_sanitized'  => true,
        'is_3ds'        => true,
    ],
    'training' => [
        'server_key'    => env('MIDTRANS_TRAINING_SERVER_KEY'),
        'client_key'    => env('MIDTRANS_TRAINING_CLIENT_KEY'),
        'is_production' => env('MIDTRANS_TRAINING_IS_PRODUCTION') === 'true',
        'is_sanitized'  => true,
        'is_3ds'        => true,
    ],
];