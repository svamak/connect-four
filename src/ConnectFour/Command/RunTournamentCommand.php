<?php

namespace ConnectFour\Command;

use ConnectFour\Fight;
use ConnectFour\Game;
use ConnectFour\Player\PlayerFinder;
use Dardarlt\Tournaments\EventDispatcher;
use Dardarlt\Tournaments\TournamentContext;
use Dardarlt\Tournaments\TournamentRunner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
        $totalTimes = $this->countAllFights($count);

        $output->writeln('<info>Game Progress</info>');
        $progress = new ProgressBar($output, $totalTimes);
        $progress->start($output, $count);

        $connectFourFight = new Fight(new EventDispatcher(), $progress);
        $tournamentRunner = new TournamentRunner($connectFourFight, $this->getPlayers());
        $tournamentResults = $tournamentRunner->runTournament('RoundRobin', $count);

        $progress->finish();

        $this->outputTournamentTable($output, $tournamentResults);
        $this->outputPoints($output, $tournamentResults);
    }

    private function getPlayers()
    {
        return PlayerFinder::getAvailablePlayers();
    }

    protected function countAllFights($count)
    {
        $totalPlayers = count($this->getPlayers());
        $playerFightTimes = $totalPlayers * $totalPlayers;
        return $playerFightTimes *   $count;
    }

    /**
     * @param OutputInterface $output
     * @param $tournamentResults
     */
    protected function outputPoints(OutputInterface $output, TournamentContext $tournamentResults)
    {
        $i = 0;
        $output->writeln('<info>Player points</info>');
        foreach ($tournamentResults->getPoints() as $player => $playerPoints) {
            $output->writeln(
                sprintf(
                    '%d. %s: %d',
                    ++$i,
                    $player,
                    $playerPoints
                )
            );
        }
    }

    /**
     * @param OutputInterface $output
     * @param $tournamentResults
     */
    protected function outputTournamentTable(OutputInterface $output, TournamentContext $tournamentResults)
    {
        $output->writeln('');
        $output->writeln('<info>Tournament table</info>');
        $table = $this->getHelper('table');

        $headers = array_keys($tournamentResults->getResults());
        array_unshift($headers, ' ');
        $table->setHeaders($headers);

        foreach ($tournamentResults->getResults() as $player => $gameResults) {
            array_unshift($gameResults, $player);
            $table->addRow($gameResults);
        }
        $table->render($output);
    }
}
