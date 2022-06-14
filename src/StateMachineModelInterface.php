<?php

namespace Chareice\LaravelEloquentFSM;

interface StateMachineModelInterface
{
    /**
     * @return array<Event>
     */
    public function events(): array;

    public static function defaultState(): mixed;

    public function createStateMachine(): StateMachineInterface;

    public function getStateMachine(): StateMachineInterface;

    public function currentState(): mixed;

    public function updateState($newState): void;

    public function saveLog($from, Event $event, $context = null);

    public function getId();
}
