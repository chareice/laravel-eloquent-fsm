<?php

namespace Chareice\LaravelEloquentFSM;

use Chareice\LaravelEloquentFSM\Commands\LaravelEloquentFSMCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigration('create_eloquent_fsm_table')
            ->hasCommand(LaravelEloquentFSMCommand::class);
    }
}
