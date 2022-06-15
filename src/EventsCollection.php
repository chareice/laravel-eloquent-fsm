<?php

namespace Chareice\LaravelEloquentFSM;

class EventsCollection
{
    /** @var array<Event> */
    protected array $events;

    protected array $eventsMap;

    /**
     * @param array<Event> $events
     */
    public function __construct(array $events)
    {
        $this->events = $events;

        /** @var Event $event */
        foreach ($this->events as $event) {
            $this->eventsMap[$event->getName()] = $event;
        }
    }

    public function getEvent($name)
    {
        return $this->eventsMap[$name] ?? null;
    }
}
