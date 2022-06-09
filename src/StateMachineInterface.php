<?php

namespace Chareice\LaravelEloquentFSM;

/**
 * @template T
 */
interface StateMachineInterface
{
    /**
     * @return T
     */
    public function currentState();

    /**
     * @param mixed $eventName
     * @param $context
     * @return bool
     */
    public function runEvent(mixed $eventName, $context = null): bool;

    /**
     * @param mixed $eventName
     * @return bool
     */
    public function canRun(mixed $eventName): Event | bool;
}
