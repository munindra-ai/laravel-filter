<?php

namespace Munindraai\LaravelFilter;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Munindraai\LaravelFilter\Commands\LaravelFilterCommand;

class LaravelFilterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-filter')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_filter_table')
            ->hasCommand(LaravelFilterCommand::class);
    }
}
