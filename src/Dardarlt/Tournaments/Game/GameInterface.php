<?php
namespace Dardarlt\Tournaments\Game;

interface GameInterface
{
    /**
     * Game interface. Each tournament consist of games.
     * Every player plays by tournament rules
     *
     * @return string Winning player id
     */
    public function play();
}
