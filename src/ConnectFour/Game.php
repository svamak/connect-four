<?php

namespace ConnectFour;

use ConnectFour\Game\Exception\EndGameException;
use ConnectFour\Game\Exception\WinnerException;
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
     * @var PlayerInterface|null
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
    public function __construct(PlayerInterface $player1, PlayerInterface $player2 = null, Grid $grid = null)
    {
        $this->grid = $grid ? $grid : new Grid();
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    /**
     * Makes next move on a game
     * @throws EndGameException
     */
    public function move()
    {
        $this->grid->addDisk(
            Grid::DISK_PLAYER_1,
            $this->player1->move($this->grid->getRepresentation(Grid::DISK_PLAYER_1))
        );
        $this->player2 && $this->grid->addDisk(
            Grid::DISK_PLAYER_2,
            $this->player2->move($this->grid->getRepresentation(Grid::DISK_PLAYER_2))
        );
    }

    /**
     * Plays full game until we have a winner or grid is full
     * @return string|null
     */
    public function play()
    {
        $maxMoves = $this->grid->getMaxMoves();
        for ($i = 0; $i < $maxMoves; $i+= 2) {
            try {
                $this->move();
            } catch (WinnerException $ex) {
                return $ex->getDisk();
            } catch (EndGameException $ex) {
                // nothing to do here
            }
        }

        return null;
    }
}
