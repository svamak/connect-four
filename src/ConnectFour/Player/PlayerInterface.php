<?php

namespace ConnectFour\Player;

/**
 * this interface defines behavior of game player
 */
interface PlayerInterface
{
    /**
     * Disk labels
     */
    const DISK_LABEL_MINE = 1;
    const DISK_LABEL_OPPONENT = 2;

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
     * @return int 0 to 5 representation of column to drop disk
     */
    public function move($grid);
}
