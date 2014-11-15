<?php

namespace ConnectFour\Test\Unit\Game\Grid;

use ConnectFour\Game\Exception\WinnerException;
use ConnectFour\Game\Grid;
use ConnectFour\Game\Grid\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * test if we do nothing with valid grid
     */
    public function testValidGrid()
    {
        Validator::validate(new Grid());
    }

    /**
     * @return array
     */
    public function getTestWinnerData()
    {
        $out = [];

        // case #0
        $out[] = [
            [
                [0, 0, 1, 1, 1, 2, 0],
                [0, 0, 1, 1, 2, 0, 0],
                [0, 0, 1, 2, 2, 0, 0],
                [0, 0, 2, 2, 1, 0, 0],
                [0, 0, 0, 1, 1, 0, 0],
                [0, 0, 0, 0, 2, 0, 0]
            ]
        ];

        // case #1
        $out[] = [
            [
                [0, 0, 1, 1, 1, 2, 0],
                [0, 0, 1, 1, 2, 0, 0],
                [0, 0, 1, 2, 2, 0, 0],
                [0, 0, 1, 2, 1, 0, 0],
                [0, 0, 0, 1, 1, 0, 0],
                [0, 0, 0, 0, 2, 0, 0]
            ]
        ];

        // case #2
        $out[] = [
            [
                [0, 1, 1, 1, 1, 2, 0],
                [0, 0, 1, 1, 2, 0, 0],
                [0, 0, 1, 2, 2, 0, 0],
                [0, 0, 0, 2, 1, 0, 0],
                [0, 0, 0, 1, 1, 0, 0],
                [0, 0, 0, 0, 2, 0, 0]
            ]
        ];

        return $out;
    }

    /**
     * test if we detect win
     *
     * @dataProvider getTestWinnerData
     * @expectedException \ConnectFour\Game\Exception\WinnerException
     */
    public function testWinner($grid)
    {
        Validator::validate(new Grid($grid));
    }
}
