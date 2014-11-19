<?php


namespace Dardarlt\Tournaments\Tournament\Result;

class RoundRobinGameResult
{
    protected $player;

    protected $competitor;

    protected $winner;

    const WIN = 2;

    const LOOSE = 0;

    const DRAW = 1;

    public function __construct($player, $competitor, $winner)
    {
        if ($player === $competitor) {
            throw new \LogicException('Player cannot play again himself!');
        }

        $this->competitor = $competitor;
        $this->player = $player;
        $this->winner = $winner;
    }

    public function getPairId()
    {
        return sprintf(
            '%s - %s',
            $this->player,
            $this->competitor
        );
    }

    public function getPoints()
    {
        if (!isset($this->winner)) {
            return self::DRAW;
        }

        return $this->player == $this->winner ? self::WIN : self::LOOSE;
    }
}
