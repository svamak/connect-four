<?php

namespace ConnectFour;

use ConnectFour\Game\Grid;
use ConnectFour\Player\PlayerInterface;

/**
 * This class represents single game
 */
class Game
{
    /**
     * Disk count in same line to win the game
     */
    const COUNT_DISK_TO_WIN = 4;

    /**
     * @var PlayerInterface
     */
    private $player1;

    /**
     * @var PlayerInterface
     */
    private $player2;

    /**
     * @var Grid
     */
    private $grid;

    /**
     * @param PlayerInterface $player1
     * @param PlayerInterface $player2
     * @param Grid $grid
     */
    public function __construct(PlayerInterface $player1, PlayerInterface $player2, Grid $grid = null)
    {
        $this->grid = $grid;
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    /**
     * Makes next move on a game
     */
    public function move()
    {

    }

    /**
     * Plays full game
     */
    public function play()
    {

    }
}
