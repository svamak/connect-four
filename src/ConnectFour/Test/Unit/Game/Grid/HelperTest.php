<?php

namespace ConnectFour\Test\Unit\Game\Grid;

use ConnectFour\Game\Grid\Helper;

/**
 * This class holds unit tests for grid helper
 */
class HelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return array
     */
    public function getTestGetRow()
    {
        $out = [];

        $grid1 = [
            [0, 0, 0, 1, 1, 2, 0],
            [0, 0, 0, 0, 2, 0, 0],
            [0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0]
        ];

        // case #0
        $out[] = [
            $grid1,
            0,
            [0, 0, 0, 1, 1, 2, 0]
        ];

        // case #1
        $out[] = [
            $grid1,
            1,
            [0, 0, 0, 0, 2, 0, 0]
        ];

        return $out;
    }

    /**
     * Test if we are able to get right row
     *
     * @dataProvider getTestGetRow()
     * @param array $grid
     * @param int $row
     * @param array $expected
     */
    public function testGetRow($grid, $row, $expected)
    {
        $this->assertEquals($expected, Helper::getRow($grid, $row));
    }
}
