<?php

namespace Dardarlt\Tournaments\Tournament;


use Dardarlt\Tournaments\Fight\FightInterface;
use Dardarlt\Tournaments\Tournament\Result\RoundRobinGameResult;

class RoundRobinTournament implements TournamentInterface
{
    protected $playerList;

    protected $game;

    protected $results = array();

    protected $points = array();

    const NO_RESULT = '#';

    public function __construct(PlayerList $playerList, FightInterface $fight)
    {
        $this->playerList = $playerList;
        $this->fight = $fight;
    }

    public function run($times = 1)
    {
        foreach ($this->playerList as $player) {
            foreach ($this->playerList as $competitor) {
                if ($competitor !== $player) {
                    foreach (range(0, $times) as $fightNumber) {
                        $this->addResult(
                            $player,
                            $competitor,
                            $this->fight->makeFight($player, $competitor),
                            $fightNumber
                        );
                    }

                } else {
                    $this->addEmptyResult($player);
                }
            }
        }
    }

    protected function addEmptyResult($player)
    {
        $result = new RoundRobinGameResult($player, null, null);
        $this->results[$player][$result->getPairId()] = self::NO_RESULT;
    }

    public function addResult($player, $competitor, $winner)
    {
        $winner = $this->getWinnerName($player, $competitor, $winner);

        $result = new RoundRobinGameResult($player, $competitor, $winner);
        if (isset($this->results[$player][$result->getPairId()])) {
            $this->results[$player][$result->getPairId()] += $result->getPoints();
        } else {
            $this->results[$player][$result->getPairId()] = $result->getPoints();
        }

        $this->addPoints($player, $result->getPoints());
    }

    public function addPoints($player, $points)
    {
        if (isset($this->points[$player])) {
            $this->points[$player] += $points;
        } else {
            $this->points[$player] = $points;
        }

    }

    public function getResults()
    {
        if (!isset($this->results)) {
            throw new \RuntimeException('You must run game first to get results');
        }

        return $this->results;
    }

    public function getPlayerPoints($player)
    {
        return $this->points[$player];
    }


    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param $player
     * @param $competitor
     * @param $winner
     *
     * @return string
     */
    protected function getWinnerName($player, $competitor, $winner)
    {
        if (isset($winner)) {
            $winner = $winner === $this->fight->getFighter1Index() ? $player : $competitor;
            return $winner;
        } else {
            $winner = FightInterface::FIGHT_DRAW;
            return $winner;
        }
    }
}
