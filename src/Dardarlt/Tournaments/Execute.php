<?php

namespace Dardarlt\Tournaments;

use Dardarlt\Tournaments\Game\GameInterface;

class Execute
{
    protected $game;

    protected $players;

    function __construct(GameInterface $game, array $players)
    {
        $this->game = $game;
        $this->players = $players;
    }

    public function runTournament($tournamentType){

        $tournament = TournamentFactory::createTournament($tournamentType);
        $tournamentContext = new TournamentContext($tournament);

        return $tournamentContext->execute();
    }
}
