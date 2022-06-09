<?php

namespace Chareice\LaravelEloquentFSM\Tests;

use Chareice\LaravelEloquentFSM\EloquentFSM;
use Chareice\LaravelEloquentFSM\Event;
use Chareice\LaravelEloquentFSM\EventsCollection;
use Chareice\LaravelEloquentFSM\StateMachineInterface;
use Chareice\LaravelEloquentFSM\StateMachineModelInterface;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model implements StateMachineModelInterface
{

    public int $counter = 0;

    protected $table = 'tests';

    protected ?StateMachineInterface $stateMachine = null;

    protected $casts = [
        'state' => TestState::class,
    ];

    public function events(): EventsCollection
    {
        return new EventsCollection([
            Event::builder()->setName('pay')->setFrom(TestState::PENDING)->setTo(TestState::PAID)->setAfter(function() {
                $this->counter = 1;
            })->build(),

            Event::builder()->setName('ship')->setFrom(TestState::PAID)->setTo(TestState::SHIPPED)->build(),
        ]);
    }

    public static function defaultState(): TestState
    {
        return TestState::PENDING;
    }

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

    public function currentState(): TestState
    {
        return $this->state;
    }

    public function updateState($newState)
    {
        $this->setAttribute('state', $newState);
        $this->save();
    }
}
