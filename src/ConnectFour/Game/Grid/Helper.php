<?php

namespace ConnectFour\Game\Grid;

/**
 * This class has helper methods to deal with raw grid
 */
class Helper
{
    /**
     * Extract array representation of column
     *
     * @param array $grid
     * @param int $column
     * @return array
     */
    public static function getColumn($grid, $column)
    {
        $callback = function ($row) use ($column) {
            return $row[$column];
        };

        return array_filter(
            array_map($callback, $grid)
        );
    }

    /**
     * Returns row of a grid
     *
     * @param array $grid
     * @param int $row
     * @return array
     */
    public static function getRow($grid, $row)
    {
        return $grid[$row];
    }
}
