<?php


namespace Dardarlt\Tournaments\Tournament;


use Dardarlt\Tournaments\Fight\FightInterface;
use Dardarlt\Tournaments\Game\GameInterface;

class RoundRobinTournament implements TournamentInterface
{
    protected $playerList;

    protected $game;

    protected $results = array();

    public function __construct(PlayerList $playerList, FightInterface $fight)
    {
        $this->playerList = $playerList;
        $this->fight = $fight;
    }

    public function run($times = 1)
    {
        $this->results = [
            $this->fight->getFighter1Index() => 0,
            $this->fight->getFighter2Index() => 0,
            FightInterface::FIGHT_DRAW => 0
        ];

        foreach ($this->playerList as $player) {
            foreach ($this->playerList as $competitor) {
                if ($competitor !== $player) {
                    foreach (range(0, $times) as $fightNumber) {
                        $winner = $this->fight->makeFight($player, $competitor);
                        $this->results[isset($winner) ? $winner : FightInterface::FIGHT_DRAW ]++;
                    }
                }
            }
        }
    }

    public function getResults()
    {
        if (!isset($this->results)) {
            throw new \RuntimeException('You must run game first to get results');
        }

        return $this->results;
    }
}
 