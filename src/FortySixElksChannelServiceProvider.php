<?php

namespace Grafstorm\FortySixElksChannel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FortySixElksChannelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-46elks-notification-channel')
            ->hasConfigFile();
    }

    public function register()
    {
        $this->app->singleton('laravel-46elks-notification-channel', function ($app) {
            return new FortySixElks();
        });

        $this->app->alias('laravel-46elks-notification-channel', FortySixElks::class);

        parent::register();
    }
}
