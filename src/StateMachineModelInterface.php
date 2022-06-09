<?php

namespace Chareice\LaravelEloquentFSM;

interface StateMachineModelInterface
{
    public function events(): EventsCollection;

    public static function defaultState(): mixed;

    public function createStateMachine(): StateMachineInterface;

    public function getStateMachine(): StateMachineInterface;

    public function currentState(): mixed;

    public function updateState($newState);
}
