<?php

namespace Chareice\LaravelEloquentFSM\Tests;

use Chareice\LaravelEloquentFSM\Event;
use Chareice\LaravelEloquentFSM\HasStateMachine;
use Chareice\LaravelEloquentFSM\StateMachineModelInterface;
use Illuminate\Database\Eloquent\Model;

class TestModel extends Model implements StateMachineModelInterface
{
    use HasStateMachine;

    public int $counter = 0;

    protected $table = 'tests';

    protected $casts = [
        'state' => TestState::class,
    ];

    public function events(): array
    {
        return [
            Event::builder()
                ->setName('pay')
                ->setFrom(TestState::PENDING)
                ->setTo(TestState::PAID)
                ->setAfter(function () {
                    $this->counter = 1;
                })
                ->build(),

            Event::builder()
                ->setName('ship')
                ->setFrom(TestState::PAID)
                ->setTo(TestState::SHIPPED)
                ->build(),
        ];
    }

    public static function defaultState(): TestState
    {
        return TestState::PENDING;
    }
}
