<?php


namespace ConnectFour\Test\Unit\Game;

use ConnectFour\Game;
use \Mockery as m;
use ConnectFour\Game\Exception\WinnerException;

class GameTest extends \PHPUnit_Framework_TestCase {

    public function testMoveIsMade()
    {
        $grid  = m::mock(
            'ConnectFour\Game\Grid[getRepresentation]',
            function($grid) {
                $grid->shouldReceive('getRepresentation')
                ->andReturn(
                    [
                        [0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0],
                        [0, 0, 0, 0, 0, 0, 0]
                    ]
                );
            }
        );

        $player1  = m::mock(
            'ConnectFour\Player\PlayerInterface',
            function($player1) {
                $player1
                    ->shouldReceive('move')
                    ->andReturn(1);
                }
        );

        $player2 = m::mock('ConnectFour\Player\PlayerInterface',
            function($player1) {
                $player1
                    ->shouldReceive('move')
                    ->andReturn(2);
            }
        );

        $game = new Game($player1, $player2, $grid);
        $game->move();

    }

    /**
     * @expectedException \ConnectFour\Game\Exception\EndGameException
     */
    public function testMoveIsNotPossibleAsGridIsFull()
    {
        $grid  = m::mock(
            'ConnectFour\Game\Grid[getRepresentation]',
            function($grid) {
                $grid->shouldReceive('getRepresentation')
                    ->andReturn(
                        [
                            [1, 2, 1, 2, 1, 2, 1],
                            [2, 1, 2, 1, 2, 1, 2],
                            [1, 2, 1, 2, 1, 2, 1],
                            [1, 2, 1, 2, 1, 2, 1],
                            [2, 1, 2, 1, 2, 1, 2],
                            [2, 1, 2, 1, 2, 1, 2],
                        ]
                    );
            }
        );

        $player1  = m::mock(
            'ConnectFour\Player\PlayerInterface',
            function($player1) {
                $player1
                    ->shouldReceive('move')
                    ->andReturn(1);
            }
        );

        $player2 = m::mock('ConnectFour\Player\PlayerInterface');

        $game = new Game($player1, $player2, $grid);
        $game->move();

    }

    /**
     * @expectedException \ConnectFour\Game\Exception\WinnerException
     */
    public function testMoveIsNotPossibleAsPlayerShouldWin()
    {
        $grid  = m::mock(
            'ConnectFour\Game\Grid[getRepresentation]',
            function($grid) {
                $grid->shouldReceive('getRepresentation')
                    ->andReturn(
                        [
                            [1, 2, 1, 2, 1, 2, 1],
                            [2, 1, 2, 1, 2, 1, 2],
                            [1, 2, 1, 2, 1, 2, 1],
                            [2, 1, 2, 1, 2, 1, 2],
                            [1, 2, 1, 2, 1, 2, 1],
                            [2, 1, 2, 1, 2, 1, 2],
                        ]
                    );
            }
        );

        $player1  = m::mock(
            'ConnectFour\Player\PlayerInterface',
            function($player1) {
                $player1
                    ->shouldReceive('move')
                    ->andReturn(1);
            }
        );

        $player2 = m::mock('ConnectFour\Player\PlayerInterface');

        $game = new Game($player1, $player2, $grid);
        $game->move();

    }
}
 