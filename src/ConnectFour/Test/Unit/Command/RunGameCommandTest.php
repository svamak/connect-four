<?php

namespace ConnectFour\Test\Unit\Command;

use ConnectFour\Command\RunGameCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class RunGameCommandTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        if (!class_exists('Symfony\Component\Console\Application')) {
            $this->markTestSkipped('Symfony Console is not available.');
        }
    }

    public function testCommandIsWorking()
    {
        $application = new Application();
        $application->add(new RunGameCommand());

        $command = $application->find('run:game');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
        $this->assertRegExp('/works/', $commandTester->getDisplay());
    }
}
