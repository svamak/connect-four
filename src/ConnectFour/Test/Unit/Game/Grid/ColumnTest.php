<?php

namespace ConnectFour\Test\Unit\Game\Grid;

use ConnectFour\Game\Grid;

/**
 * This class holds unit tests for Column
 */
class ColumnTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \OverflowException
     */
    public function testPushOverflow()
    {
        $column = new Grid\Column();
        for ($i = 0; $i < Grid::COUNT_ROW + 1; $i++) {
            $column->push(Grid::DISK_PLAYER_1);
        }
    }

    /**
     * Test if we are able to get correct symbol pushed
     */
    public function testGet()
    {
        $column = new Grid\Column();
        $column->push(Grid::DISK_PLAYER_2);
        $column->push(Grid::DISK_PLAYER_1);

        $this->assertEquals(Grid::DISK_PLAYER_1, $column->get(1));
    }

    /**
     * Test if we return 0 in case of empty symbol
     */
    public function testGetEmpty()
    {
        $column = new Grid\Column();
        $column->push(Grid::DISK_PLAYER_2);
        $column->push(Grid::DISK_PLAYER_1);

        $this->assertEquals(0, $column->get(2));
    }
}
