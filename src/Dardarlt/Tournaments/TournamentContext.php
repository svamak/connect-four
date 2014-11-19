<?php


namespace Dardarlt\Tournaments;

use Dardarlt\Tournaments\Tournament\TournamentInterface;

class TournamentContext
{
    protected $strategy;

    public function __construct(TournamentInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute()
    {
         $this->strategy->run();
        return $this->strategy->getResults();
    }
}
 