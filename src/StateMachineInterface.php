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
     * @param string $eventName
     * @param $context
     * @return bool
     */
    public function runEvent(string $eventName, $context = null): bool;

    /**
     * @param string $eventName
     * @return bool
     */
    public function canRun(string $eventName): Event | bool;
}
