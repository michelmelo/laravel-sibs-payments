# laravel-sibs-payments



## Installation

Require this package with composer. It is recommended to only require the package for development.

```shell
composer require michelmelo/laravel-sibs-payments
```


If you don't use auto-discovery, add the ServiceProvider to the providers array in config/app.php

```php
MichelMelo\Sibs\SibsPaymentsProvider::class,
```

If you want to use the facade, add this to your facades in app.php:

```php
'Sibs' => MichelMelo\Sibs\Facade\Sibs::class,
```

Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --provider="MichelMelo\Sibs\SibsPaymentsProvider"
```

