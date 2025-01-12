<p align="center"><img src="/art/socialcard.png" alt="URL Down Package for Laravel"></p>

# URL Down Package for Laravel

<!--[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-permission.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-permission)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-permission/run-tests-L8.yml?branch=main&label=Tests)](https://github.com/spatie/laravel-permission/actions?query=workflow%3ATests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-permission.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-permission)


## Documentation, Installation, and Usage Instructions

See the [documentation](https://spatie.be/docs/laravel-permission/) for detailed installation and usage instructions.
-->

## What It Does
The ```url_down``` package allows you to easily put a specific URL or route of your Laravel application under maintenance or bring it back up. It provides Artisan commands to manage site maintenance on a per-route basis.

## Installation

To install the package, run the following Composer command:

```php
composer require akshay/url_down
```
After installation, the service provider will be automatically registered if you're using Laravel 5.5 or later, thanks to package auto-discovery. For earlier versions of Laravel, you may need to add the service provider manually to your config/app.php file:

```php
'providers' => [
    // Other Service Providers...
    Akshay\Url_down\UrlDownServiceProvider::class,
],
```
Next, publish the configuration file:
```php
php artisan vendor:publish --provider="Akshay\Url_down\UrlDownServiceProvider"
```
This will publish the urldown.php configuration file to the config directory of your application.

## Configuration
The configuration file config/urldown.php contains the settings for this package:


```php
return [
    'routes_path' => storage_path('framework/under_maintenance_routes.json'),
    'error_code' => 500,
];
```
- ```routes_path:``` The routes_path is used to define the storage location for the route in the cache directory. You can customize this path to suit your project's structure.
- ```error_code:``` The HTTP status code to show when a route is down (default is 503).

You can modify these settings as per your needs.

## Commands
This package provides two Artisan commands:

```php artisan route:down```

This command will set a specific route or URL as "under maintenance". It will ask you to select the route name, and then it will mark it as down, showing the maintenance message and error code specified in the configuration.

Usage:

```php
php artisan route:down
```
After running the command, it will ask you to select the route name. Once a route is selected, it will be marked as down, and the configured error page will be displayed when that route is accessed.

```php artisan route:up```
This command will bring a specific route or URL back online by removing it from maintenance mode. It will ask you to select the route name and remove it from the "under maintenance" state.
Usage:

```php
php artisan route:up
```
After running this command, the selected route will be restored, and it will no longer show the maintenance page.

## How It Works

+ The package works by storing the "down" routes in a list (which can be stored in a file, database, or any other medium you prefer).
- When a route is marked as "down", an error page will be displayed with the specified HTTP error code and the maintenance message.
- If the route is brought back up, it will start functioning as normal.

## Example Usage:
+ Run ```php artisan route:down```, then select a route like ```/some-page```. Now, any user visiting ```/some-page``` will see a ```"Service Unavailable"``` page (HTTP ```503```).
- Run ```php artisan route:up``` to bring ```/some-page``` back online.

## Laravel Framework Support
This package is specifically designed to work with Laravel applications and will not function properly outside of the Laravel framework. Ensure you're using Laravel 5.5 or later for automatic package discovery.

### Testing

``` bash
composer test
```

### Security

If you discover any security-related issues, please email [patelakshay3943@gmail.com](mailto:patelakshay3943@gmail.com) instead of using the issue tracker.

## Credits

- [AKshay Patel](https://github.com/patelakshay3943)
<!--
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
-->
