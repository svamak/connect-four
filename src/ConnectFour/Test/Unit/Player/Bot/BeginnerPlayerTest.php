<?php

namespace ConnectFour\Test\Unit\Player\Bot;

use ConnectFour\Game\Grid;
use ConnectFour\Player\Bot\BeginnerPlayer;

class BeginnerPlayerTest extends \PHPUnit_Framework_TestCase
{

    protected $emptyGrid = [
            [0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0],
    ];

    public function testGetsHotPattern()
    {
        $player = new BeginnerPlayer();
        $filled = $player->getHotPattern(Grid::DISK_PLAYER_1);

        $this->assertEquals(
            [
                Grid::DISK_PLAYER_1,
                Grid::DISK_PLAYER_1,
                Grid::DISK_PLAYER_1
            ],
            $filled
        );
    }


    public function testHasThree()
    {
        $player = new BeginnerPlayer();
        $move = $player->hasThree(
            [
                [0,1,0,1,Grid::DISK_PLAYER_2,Grid::DISK_PLAYER_2,0],
                [0,0,0,1,Grid::DISK_PLAYER_2,0,0],
                [0,0,0,0,Grid::DISK_PLAYER_2,0,0],
                [0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0]
            ],
            4
        );
        $this->assertEquals(true, $move);
    }

    public function testFindsHotColumn()
    {
        $player = new BeginnerPlayer();
        $move = $player->getHotColumn(
            [0,1,2,3,4,5,6],
            [
                [0,1,0,1,Grid::DISK_PLAYER_2,Grid::DISK_PLAYER_2,0],
                [0,0,0,1,Grid::DISK_PLAYER_2,0,0],
                [0,0,0,0,Grid::DISK_PLAYER_2,0,0],
                [0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0]
            ]
        );
        $this->assertEquals(4, $move);
    }

    public function testGetsFirstThree()
    {
        $player = new BeginnerPlayer();
        $move = $player->getFirstThree(
            [
                [0,1,0,1,Grid::DISK_PLAYER_2,Grid::DISK_PLAYER_2,0],
                [0,0,0,1,Grid::DISK_PLAYER_2,0,0],
                [0,0,0,0,Grid::DISK_PLAYER_2,0,0],
                [0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0]
            ],
            4
        );
        $this->assertEquals([Grid::DISK_PLAYER_2, Grid::DISK_PLAYER_2, Grid::DISK_PLAYER_2], $move);
    }

    public function testMakesSmartMove()
    {
        $player = new BeginnerPlayer();
        $move = $player->move(
            [
                [0,1,0,1,Grid::DISK_PLAYER_2,Grid::DISK_PLAYER_2,0],
                [0,0,0,1,Grid::DISK_PLAYER_2,0,0],
                [0,0,0,0,Grid::DISK_PLAYER_2,0,0],
                [0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0]
            ]
        );
        $this->assertEquals(4, $move);
    }

    public function testReturnsValidColumn()
    {
        $player = new BeginnerPlayer();
        $move = $player->move($this->emptyGrid);
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

        $player = new BeginnerPlayer();
        $this->assertEquals(2, $player->move($grid));
    }
}
