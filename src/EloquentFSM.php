<?php

namespace Chareice\LaravelEloquentFSM;

use Illuminate\Support\Facades\DB;

class EloquentFSM implements StateMachineInterface
{
    protected EventsCollection $events;

    public function __construct(protected StateMachineModelInterface $model)
    {
        $this->events = new EventsCollection($this->model->events());
    }

    public function currentState()
    {
        return $this->model->currentState();
    }

    /**
     * @throws \Exception
     */
    public function runEvent(mixed $eventName, $context = null): bool
    {
        $eventToRun = $this->canRun($eventName);

        if (! $eventToRun) {
            return false;
        }

        DB::beginTransaction();

        $beforeState = $this->currentState();

        try {
            if ($before = $eventToRun->getBefore()) {
                call_user_func($before);
            }

            $newState = $eventToRun->getTo();
            $this->model->updateState($newState);

            if ($after = $eventToRun->getAfter()) {
                call_user_func($after);
            }


            $this->model->saveLog($beforeState, $eventToRun, $context);
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function canRun(mixed $eventName): Event | bool
    {
        /** @var Event $event */
        if ($event = $this->events->getEvent($eventName)) {
            if (in_array($this->currentState(), $event->getFrom())) {
                return $event;
            }
        }

        return false;
    }
}
