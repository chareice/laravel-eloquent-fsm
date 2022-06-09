<?php

namespace Chareice\LaravelEloquentFSM;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Chareice\LaravelEloquentFSM\Commands\LaravelEloquentFSMCommand;

class LaravelEloquentFSMServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-eloquent-fsm')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-eloquent-fsm_table')
            ->hasCommand(LaravelEloquentFSMCommand::class);
    }
}
