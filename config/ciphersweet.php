<?php

return [
    'backend' => env('CIPHERSWEET_BACKEND'),
    'provider' => env('CIPHERSWEET_PROVIDER'),
    'providers' => [
        'file' => [
            'path' => env('CIPHERSWEET_FILE_PATH'),
        ],
        'string' => [
            'key' => env('CIPHERSWEET_KEY'),
        ],
    ],
];
