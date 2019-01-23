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
    'access_token' => '',
    'timeout' => 5.0,
    'httpOptions' => [],
];
```

## Use

```php
use Larva\Client\Larva;

$response = Larva::get('api/oatuh/test');
print_r($response);

```