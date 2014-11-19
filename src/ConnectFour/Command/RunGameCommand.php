<?php

namespace ConnectFour\Command;

use ConnectFour\Player\Factory\PlayerFactory;
use ConnectFour\Game;
use ConnectFour\Player\PlayerFinder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class RunGameCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('run:game')
            ->setDescription('Runs a game between players')
            ->addOption('times', 't', InputOption::VALUE_OPTIONAL, 'Number of games will be played', 1);
           ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        list($playerName1, $playerName2) = $this->enterPlayers($input, $output);
        $count = (int) $input->getOption('times');

        $gameResults = [
            Game\Grid::DISK_PLAYER_1 => 0,
            Game\Grid::DISK_PLAYER_2 => 0,
            Game::DRAW => 0
        ];

        $output->writeln('<info>Game Progress</info>');
        $progress = $this->getHelper('progress');
        $progress->start($output, $count);
        foreach (range(0, $count-1) as $num) {
            $game = new Game(
                PlayerFactory::createPlayer($playerName1),
                PlayerFactory::createPlayer($playerName2)
            );

            $winner = $game->play();
            $gameResults[isset($winner) ? $winner : Game::DRAW ]++;
            $progress->advance();
        }
        $progress->finish();

        $output->writeln('<info>Game results</info>');

        $table = $this->getHelper('table');
        $table->setHeaders([$playerName1, $playerName2, Game::DRAW]);
        $table->addRow(array_values($gameResults));
        $table->render($output);

    }

    private function getPlayers()
    {
        return PlayerFinder::getAvailablePlayers();
    }

    protected function createQuestion($playerTitle)
    {
        $question = new Question(
            sprintf('Please select %d player name [%s]:', $playerTitle, implode(", ", $this->getPlayers()))
        );
        $question->setAutocompleterValues($this->getPlayers());
        return $question;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return array
     */
    protected function enterPlayers(InputInterface $input, OutputInterface $output)
    {
        $players = [];
        $helper = $this->getHelper('question');
        foreach ([1, 2] as $title) {
            $question = $this->createQuestion($title);
            $players[] = $helper->ask($input, $output, $question);
        }

        list($player1, $player2) = $players;
        return array($player1, $player2);
    }
}
