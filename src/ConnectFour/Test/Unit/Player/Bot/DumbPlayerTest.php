<?php

namespace ConnectFour\Test\Unit\Player\Bot;

use ConnectFour\Player\Bot\DumbPlayer;

class DumbPlayerTest extends \PHPUnit_Framework_TestCase
{

    protected $emptyGrid = [
        [1, 2, 0, 2, 1, 2, 1],
        [2, 1, 0, 1, 2, 1, 2],
        [1, 2, 0, 2, 1, 2, 1],
        [1, 2, 0, 2, 1, 2, 1],
        [2, 1, 0, 1, 2, 1, 2],
        [2, 1, 0, 1, 2, 1, 1]
    ];

    public function testReturnsValidColumn()
    {
        $dumbPlayer = new DumbPlayer();
        $move = $dumbPlayer->move($this->emptyGrid);
        $this->assertGreaterThanOrEqual(0, $move);
        $this->assertLessThanOrEqual(6, $move);
        $this->assertInternalType("int", $move);
    }

    public function testMakesMovesInValidColumn()
    {
        $grid = [
            [1, 2, 0, 2, 1, 2, 1],
            [2, 1, 0, 1, 2, 1, 2],
            [1, 2, 0, 2, 1, 2, 1],
            [1, 2, 0, 2, 1, 2, 1],
            [2, 1, 0, 1, 2, 1, 2],
            [2, 1, 0, 1, 2, 1, 1]
        ];

        $dumbPlayer = new DumbPlayer();
        $this->assertEquals(2, $dumbPlayer->move($grid));
    }
}
