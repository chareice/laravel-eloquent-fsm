<?php

namespace Chareice\LaravelEloquentFSM;

class EventBuilder
{
    private $name;
    private $from;
    private $to;
    private $before;
    private $after;

    public function build(): Event
    {
        return new Event($this);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return ! is_array($this->from) ? [$this->from] : $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from): self
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @param mixed $before
     */
    public function setBefore($before): self
    {
        $this->before = $before;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param mixed $after
     */
    public function setAfter($after): self
    {
        $this->after = $after;

        return $this;
    }
}
