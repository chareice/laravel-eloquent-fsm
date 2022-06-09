<?php

namespace Chareice\LaravelEloquentFSM\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chareice\LaravelEloquentFSM\LaravelEloquentFSM
 */
class LaravelEloquentFSM extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-eloquent-fsm';
    }
}
