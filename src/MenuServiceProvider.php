<?php

namespace Salahhusa9\Menu;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Salahhusa9\Menu\Commands\MenuCommand;
use Salahhusa9\Menu\View\Components\Menu;

class MenuServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-menu')
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponents('', Menu::class);
    }
}
