<?php

namespace ConnectFour\Test\Unit\Game;

use ConnectFour\Game\Grid;

/**
 * This class holds unit tests for grid
 */
class GridTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidMove()
    {
        $grid = new Grid();

        $grid->addDisk(Grid::DISK_PLAYER_1, Grid::COUNT_COLUMN + 1);
    }

    /**
     * @return array
     */
    public function getTestAddDiskData()
    {
        $out = [];

        // case #0 just one simple case
        $out[] = [
            [
                [0, 0, 0, 1, 1, 2, 0],
                [0, 0, 0, 0, 2, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0]
            ],
            1,
            3,
            [
                [0, 0, 0, 1, 1, 2, 0],
                [0, 0, 0, 1, 2, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0]
            ]
        ];

        return $out;
    }

    /**
     * tests if we add disk in a correct way
     *
     * @dataProvider getTestAddDiskData()
     * @param array $grid
     * @param string $disk
     * @param int $column
     * @param array $expectedGrid
     */
    public function testAddDisk($grid, $disk, $column, $expectedGrid)
    {
        $grid = new Grid($grid);
        $grid->addDisk($disk, $column);

        $this->assertEquals($expectedGrid, $grid->getRepresentation());
    }
}
