<?php

namespace ConnectFour\Player\Factory;

use ConnectFour\Player\Exception\PlayerNotFoundException;

class PlayerFactory
{
    public static function createPlayer($name)
    {
        $className = '\ConnectFour\Player\Bot\\' . $name;

        if (!class_exists($className)) {
            throw new PlayerNotFoundException(
                sprintf('Player %s does not exist', $className)
            );
        }

        return new $className();
    }
}
