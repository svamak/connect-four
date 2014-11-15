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

    /**
     * Return line in diagonally
     *
     * @param array $grid
     * @param array $start starting point
     * @param array $direction 1 or -1
     * @return array
     */
    public static function getDiagonally($grid, $start, $direction)
    {
        $out = [];

        $validate = function ($i, $j) use ($grid, $direction) {
            return isset($grid[$i]) && isset($grid[$i][$j]);
        };

        for ($i = $start[0], $j = $start[1]; $validate($i, $j); $i += $direction[0], $j += $direction[1]) {
            $out[] = $grid[$i][$j];
        }

        return $out;
    }

    /**
     * Get available columns to add disk
     *
     * @param array $grid
     * @return array
     */
    public static function getAvailableColumns($grid)
    {
        $out = [];
        for ($i = 0; $i < count($grid[0]); $i++) {
            if (count(self::getColumn($grid, $i)) < count($grid)) {
                $out[] = $i;
            }
        }

        return $out;
    }

    /**
     * Returns true if grid is full
     *
     * @param array $grid
     * @return bool
     */
    public static function isFull($grid)
    {
        return count(self::getAvailableColumns($grid)) == 0;
    }
}
