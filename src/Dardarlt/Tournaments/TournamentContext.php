<?php


namespace Dardarlt\Tournaments;

use Dardarlt\Tournaments\Tournament\TournamentInterface;

class TournamentContext
{
    protected $strategy;

    protected $results;

    protected $points;

    public function __construct(TournamentInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute($times)
    {
        $this->strategy->run($times);
        $this->results = $this->strategy->getResults();
        $this->points = $this->strategy->getPoints();
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return array
     */
    public function getPoints()
    {
        arsort($this->points);
        return $this->points;
    }
}
