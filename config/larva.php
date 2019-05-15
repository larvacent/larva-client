<?php
return [
    'endpoint' => 'https://passport.larvacent.com',
    'client_id' => env('LARVA_CLIENT_ID', 'your-larva-client-id'),
    'client_secret' => env('LARVA_CLIENT_SECRET', 'your-larva-client-secret'),
    'scope' => '',
    'timeout' => 5.0,
    'httpOptions' => [
        //屏蔽Http 错误
        'http_errors' => false,
    ],
];