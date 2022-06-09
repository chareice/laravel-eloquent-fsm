<?php

namespace Chareice\LaravelEloquentFSM\Commands;

use Illuminate\Console\Command;

class LaravelEloquentFSMCommand extends Command
{
    public $signature = 'laravel-eloquent-fsm';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
