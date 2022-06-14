<?php

namespace Chareice\LaravelEloquentFSM;

use Illuminate\Support\Facades\Cache;

class MutexEloquentFSM extends EloquentFSM
{
    public function runEvent(mixed $eventName, $context = null): bool
    {
        return Cache::lock($this->model->getId() . "run_event")->get(function () use ($eventName, $context) {
            $this->model->refresh();

            return parent::runEvent($eventName, $context);
        });
    }
}
