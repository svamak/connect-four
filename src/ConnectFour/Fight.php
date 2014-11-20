<?php


namespace ConnectFour;


use ConnectFour\Game;
use ConnectFour\Game\Grid;
use ConnectFour\Player\Factory\PlayerFactory;
use Dardarlt\Tournaments\Event\FightEvent;
use Dardarlt\Tournaments\EventDispatcher;
use Dardarlt\Tournaments\Fight\FightInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class Fight implements FightInterface
{
    protected $fightDispatcher;

    protected $progress;

    public function __construct(EventDispatcher $fightDispatcher, ProgressBar $progress)
    {
        $this->fightDispatcher = $fightDispatcher;
        $this->progress = $progress;
    }
    

    public function makeFight($playerName1, $playerName2)
    {

        $game = new Game(
            PlayerFactory::createPlayer($playerName1),
            PlayerFactory::createPlayer($playerName2)
        );
        $this->fightDispatcher->dispatch(new FightEvent($this->progress));
        return $game->play();
    }

    public function fight($playerName1, $playerName2, $times = 1)
    {
        $gameResults = [
            Game\Grid::DISK_PLAYER_1 => 0,
            Game\Grid::DISK_PLAYER_2 => 0,
            Game::DRAW => 0
        ];
        foreach (range(0, $times) as $num) {
            $winner = $this->makeFight($playerName1, $playerName2);
            $gameResults[isset($winner) ? $winner : Game::DRAW ]++;
            $this->fightDispatcher->dispatch(new FightEvent($this->progress));
            return $gameResults;
        }
    }


    public function getFighter1Index()
    {
        return Game\Grid::DISK_PLAYER_1;
    }

    public function getFighter2Index()
    {
        return Game\Grid::DISK_PLAYER_2;
    }
}
