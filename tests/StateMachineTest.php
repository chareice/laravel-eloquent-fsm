<?php

use Chareice\LaravelEloquentFSM\Tests\TestModel;
use Chareice\LaravelEloquentFSM\Tests\TestState;

beforeEach(function () {
    TestModel::query()->create();
    $this->model = TestModel::query()->first();
    $this->stateMachine = $this->model->getStateMachine();
});


it('should register state machine', function () {
    expect($this->stateMachine->currentState())->toEqual(TestModel::defaultState());
});

it('should run can event', function () {
    expect($this->stateMachine->canRun('balabala'))->toBeFalse()
        ->and($this->stateMachine->canRun('ship'))->toBeFalse()
        ->and($this->stateMachine->canRun('pay'))->not()->toBeFalse();
});


it('should run event', function () {
    $this->stateMachine->runEvent('pay');

    expect($this->stateMachine->currentState())->toEqual(TestState::PAID);
});

it('should call event callback', function () {
    expect($this->model->counter)->toEqual(0);

    $this->stateMachine->runEvent('pay');

    expect($this->model->counter)->toEqual(1);
});


it('should save log when event call', function () {
    expect($this->model->stateMachineLogs()->count())->toEqual(0);
    $this->stateMachine->runEvent('pay', ['hello' => 'world']);
    expect($this->model->stateMachineLogs()->count())->toEqual(1);

    $log = $this->model->stateMachineLogs()->first();
    expect($log->meta)->toEqual(['hello' => 'world']);
});
