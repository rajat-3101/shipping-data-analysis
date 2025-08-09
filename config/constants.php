<?php
return [
    'ROLES' => [
        'ADMIN' => 1,
        'MANAGER' => 2,
        'USER' => 3,
    ],

    'STATUS' => [
        'INACTIVE' => 0,
        'ACTIVE' => 1,
    ],

    'ADMIN_EMAIL' => env('ADMIN_EMAIL'),
    'ADMIN_PASSWORD' => env('ADMIN_PASSWORD'),
    'USER_EMAIL' => env('USER_EMAIL'),
    'USER_PASSWORD' => env('USER_PASSWORD'),
    'REDUCTION_FACTOR' => env('REDUCTION_FACTOR'), 
];