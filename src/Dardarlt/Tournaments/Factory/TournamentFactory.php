<?php

namespace Dardarlt\Tournaments\Factory;

use Dardarlt\Tournaments\Fight\FightInterface;
use Dardarlt\Tournaments\Tournament\PlayerList;
use Dardarlt\Tournaments\Tournament\RoundRobinTournament;

class TournamentFactory
{

    protected $playerList;

    protected $fight;

    public function __construct(PlayerList $playerList, FightInterface $fight)
    {
        $this->playerList = $playerList;
        $this->fight = $fight;
    }

    public function createTournament($name)
    {
        //we have only one now :)
        return $this->createRoundRobinTournament();
    }

    public function createRoundRobinTournament()
    {
        return new RoundRobinTournament($this->playerList, $this->fight);
    }
}
