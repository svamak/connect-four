<?php


namespace Dardarlt\Tournaments\Event;


use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\ProgressHelper;

class FightEvent implements EventInterface
{
    const ITERATOR_AFTER_FIGHT = 'iterator_after_fight';

    protected $progress;
    
    public function __construct(ProgressBar $progress)
    {
        $this->progress = $progress;
        
    }
    
    public function action()
    {
        $this->progress->advance();
    }
}
