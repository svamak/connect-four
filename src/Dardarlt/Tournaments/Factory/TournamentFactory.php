<?php



class TournamentFactory
{
    public function createTournament($name)
    {
        $className = '\\Dardarlt\Tournaments\\Tournament\\' . $name;
        if (!class_exists($className))
        {
            throw new InvalidArgumentException('Game type does not exist');
        }
        return new $className;
    }
}
 