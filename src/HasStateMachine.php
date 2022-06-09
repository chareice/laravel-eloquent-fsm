<?php

namespace Chareice\LaravelEloquentFSM;

use Chareice\LaravelEloquentFSM\Models\StateMachineLog;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    public function stateMachineLogs(): MorphMany
    {
        return $this->morphMany(StateMachineLog::class, 'fsmable');
    }

    public function saveLog($from, Event $event, $context = null)
    {
        $this->stateMachineLogs()->save(new StateMachineLog([
            'from' => $from,
            'to' => $event->getTo(),
            'event' => $event->getName(),
            'meta' => $context,
        ]));
    }
}
