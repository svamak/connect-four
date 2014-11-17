<?php


namespace ConnectFour\Player;

use ConnectFour\Player\Factory\PlayerFactory;
use Symfony\Component\Finder\Finder;

class PlayerFinder
{
    const BOT_DIR = 'Bot';

    /**
     * Gets all available players
     */
    public static function getAvailablePlayers()
    {
        $players = array();
        $files = self::getBotClasses();
        foreach ($files as $file) {
            /** var $file Finder */
            $players[] = basename($file->getFileName(), '.php');
        }
        return $players;
    }

    /**
     * @return Finder
     */
    protected static function getBotClasses()
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__ . DIRECTORY_SEPARATOR . self::BOT_DIR);
        return $finder;
    }
}
