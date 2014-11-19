<?php

namespace ConnectFour\Command;

use ConnectFour\Fight;
use ConnectFour\Player\Factory\PlayerFactory;
use ConnectFour\Game;
use ConnectFour\Player\PlayerFinder;
use Dardarlt\Tournaments\EventDispatcher;
use Dardarlt\Tournaments\TournamentRunner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class RunTournamentCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('run:tournament')
            ->setDescription('Runs tournament among all players')
            ->addOption('times', 't', InputOption::VALUE_OPTIONAL, 'Number of games will be played', 1);
           ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = (int) $input->getOption('times');

        $output->writeln('<info>Game Progress</info>');
        $progress = new ProgressBar($output);
        $progress->start($output, $count);

        $connectFourFight = new Fight(new EventDispatcher(), $progress);
        $tournamentRunner = new TournamentRunner($connectFourFight, $this->getPlayers());
        $gameResults = $tournamentRunner->runTournament('RoundRobin', $count);

        $progress->finish();

        $table = $this->getHelper('table');
        $table->setHeaders(['Tournament table']);
        $table->addRow(array_values($gameResults));
        $table->render($output);

    }

    private function getPlayers()
    {
        return PlayerFinder::getAvailablePlayers();
    }
}
