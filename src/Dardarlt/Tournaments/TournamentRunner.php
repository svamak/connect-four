<?php

namespace Dardarlt\Tournaments;

use Dardarlt\Tournaments\Factory\TournamentFactory;
use Dardarlt\Tournaments\Fight\FightInterface;
use Dardarlt\Tournaments\Tournament\PlayerList;

class TournamentRunner
{
    protected $game;

    protected $players;

    public function __construct(FightInterface $game, $players)
    {
        $this->game = $game;
        $this->players = $players;
    }

    public function runTournament($tournamentType, $times)
    {
        $tournamentFactory = new TournamentFactory(new PlayerList($this->players), $this->game);

        $tournament = $tournamentFactory->createTournament($tournamentType);
        $tournamentContext = new TournamentContext($tournament);

        return $tournamentContext->execute($times);
    }
}
