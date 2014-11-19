<?php


namespace Dardarlt\Tournaments;


use Dardarlt\Tournaments\Event\EventInterface;

class EventDispatcher
{
    protected $event;

    public function dispatch(EventInterface $event)
    {
        $event->action();
    }
}
