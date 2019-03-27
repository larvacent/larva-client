<?php
return [
    'endpoint' => '',
    'client_id' => env('LARVA_CLIENT_ID', 'your-larva-client-id'),
    'client_secret' => env('LARVA_CLIENT_SECRET', 'your-larva-client-secret'),
    'scope' => '',
    'timeout' => 5.0,
    'httpOptions' => [
        'http_errors' => false,
    ],
];