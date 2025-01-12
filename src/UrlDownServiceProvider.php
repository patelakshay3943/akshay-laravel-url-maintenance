<?php

namespace Akshay\Url_down;

use Akshay\Url_down\Exceptions\DownErrorException;
use Akshay\Url_down\Helpers\Helper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class UrlDownServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register(): void
    {

        $this->app->make(UrlDownController::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            app()->booted(function () {
                $controller = $this->app->make(UrlDownController::class);
                $routeName = $controller->getRouteName();
                if ($routeName && $controller->isRouteDown($routeName)) {
                    $downStatusCode = Config::get('urldown.error_code');
                    throw new DownErrorException($downStatusCode, 'The site is temporarily unavailable. Please try again later.');
                }
            });
        }
//        include __DIR__.'/routes.php';
        $this->registerCommands();
        $this->publishes([
            __DIR__.'/urldown.php' => config_path('urldown.php'),
            __DIR__ . '/resources/views/errors/503.blade.php' => resource_path('views/errors/503.blade.php'),
        ]);

    }

    protected function registerCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Commands\Down::class,
            Commands\Up::class
        ]);
    }
}
