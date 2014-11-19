<?php

namespace Dardarlt\Tournaments\Fight;

interface FightInterface
{
    const FIGHT_DRAW = 'Draw';


    public function makeFight($player1, $player2);

    public function getFighter1Index();

    public function getFighter2Index();
}
