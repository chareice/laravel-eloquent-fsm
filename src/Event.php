<?php

namespace Chareice\LaravelEloquentFSM;

class Event
{
    protected $from;
    protected $to;
    protected $before;
    protected $after;
    protected $name;

    public function __construct(EventBuilder $builder)
    {
        $this->name = $builder->getName();
        $this->from = $builder->getFrom();
        $this->to = $builder->getTo();
        $this->before = $builder->getBefore();
        $this->after = $builder->getAfter();
    }

    public static function builder(): EventBuilder
    {
        return new EventBuilder();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getBefore()
    {
        return $this->before;
    }

    public function getAfter()
    {
        return $this->after;
    }
}
