<?php

namespace Chareice\LaravelEloquentFSM;

trait HasStateMachine
{
    protected ?StateMachineInterface $stateMachine = null;

    protected $stateColumn = 'state';

    public function createStateMachine(): StateMachineInterface
    {
        return new EloquentFSM($this);
    }

    public function getStateMachine(): StateMachineInterface
    {
        if (is_null($this->stateMachine)) {
            $this->stateMachine = $this->createStateMachine();
        }

        return $this->stateMachine;
    }

    public function currentState(): mixed
    {
        return $this->getAttribute($this->stateColumn);
    }

    public function updateState($newState): void
    {
        $this->setAttribute($this->stateColumn, $newState);
        $this->save();
    }
}
