<?php

namespace Chareice\LaravelEloquentFSM\Tests;

use Chareice\LaravelEloquentFSM\LaravelEloquentFSMServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Chareice\\LaravelEloquentFSM\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelEloquentFSMServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);


        (include __DIR__ . "/migrations/test_model_migration.php")->up();
        (include __DIR__ . "/../database/migrations/create_eloquent_fsm_table.php")->up();
    }
}
