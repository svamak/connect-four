<?php


namespace ConnectFour\Player\Bot;


use ConnectFour\Game\Grid;
use ConnectFour\Game\Grid\Helper;
use ConnectFour\Player\PlayerInterface;

class BeginnerPlayer implements PlayerInterface
{

    /**
     * Returns next move of player by given grid
     *
     * <code>
     * $grid = [
     *    [0,0,0,1,2,2,0],
     *    [0,0,0,1,2,0,0],
     *    [0,0,0,0,1,0,0],
     *    [0,0,0,0,0,0,0],
     *    [0,0,0,0,0,0,0],
     *    [0,0,0,0,0,0,0],
     * ]
     * </code>
     *
     * @param array $grid Grid representation in 7 columns, 6 rows array
     *
     * @return int 0 to 6 index of column to drop disk
     */
    public function move($grid)
    {
        $available = Helper::getAvailableColumns($grid);

        $hotColumn = $this->getHotColumn($available, $grid);
        if (null !== $hotColumn) {
            return $hotColumn;
        }

        if (rand(0, 3) === 0) {
            shuffle($available);
        }

        return array_shift($available);

    }

    public function getHotColumn($availableColumns, $grid)
    {
        foreach ($availableColumns as $column) {
            if ($this->hasThree($grid, $column)) {
                return $column;
            }
        }
        return null;
    }

    public function hasThree($array, $index)
    {
        return
            $this->getFirstThree($array, $index) == $this->getHotPattern(Grid::DISK_PLAYER_1) ||
            $this->getFirstThree($array, $index) == $this->getHotPattern(Grid::DISK_PLAYER_2);
    }

    public function getFirstThree($array, $index)
    {
        return Helper::getColumn($array, $index);
    }

    public function getHotPattern($player)
    {
        return array_fill(0, 3, $player);
    }
}
