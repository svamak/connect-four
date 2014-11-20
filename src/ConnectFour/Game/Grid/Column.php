<?php

namespace ConnectFour\Game\Grid;

use ConnectFour\Game\Grid;

/**
 * This class represents column  of game grid
 */
class Column
{
    /**
     * @var array
     */
    private $stack;

    /**
     * @var int
     */
    private $count = Grid::COUNT_ROW;

    /**
     * @param array $stack
     * @param int $count
     */
    public function __construct($stack = [], $count = Grid::COUNT_ROW)
    {
        $this->stack = $stack;
        $this->count = $count;
    }

    /**
     * Push disk into column
     *
     * @param string $disk Grid::DISK_PLAYER_1 or Grid::DISK_PLAYER_2
     */
    public function push($disk)
    {
        if (count($this->stack) < $this->count) {
            $this->stack[] = $disk;
        }
    }

    /**
     * Return symbol of given row
     *
     * @param string $row
     * @return string|int Grid::DISK_PLAYER_1 or Grid::DISK_PLAYER_2 or 0 if row is empty
     */
    public function get($row)
    {
        if (isset($this->stack[$row])) {
            return $this->stack[$row];
        }
        return 0;
    }
}
