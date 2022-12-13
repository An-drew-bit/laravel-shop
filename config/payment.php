<?php

return [
    'providers' => [
        'unitpay' => [
            'public_key' => env('UNITPAY_PUBLIC_KEY', ''),
            'secret_key' => env('UNITPAY_SECRET_KEY', ''),
        ],
        'yookassa' => [
            'login' => env('YOOKASSA_LOGIN', ''),
            'password' => env('YOOKASSA_PASSWORD', ''),
        ],
    ],
];
