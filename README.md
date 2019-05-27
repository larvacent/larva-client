# larva-client

This is a Laravel Api adapter.

## Installation

```bash
composer require larva/larva-client
```

## for Laravel

This service provider must be registered.

```php
// config/app.php

'providers' => [
    '...',
    Larva\Client\LarvaServiceProvider::class,
];
```

edit the config file: config/larva.php

add config

```php
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
```

## Use

```php
use Larva\Client\Larva;

$response = Larva::get('api/oatuh/test');
print_r($response);

```