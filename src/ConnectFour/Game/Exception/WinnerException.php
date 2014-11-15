<?php

namespace ConnectFour\Game\Exception;

/**
 * This exception is thrown when winner disk exists on grid
 */
class WinnerException extends EndGameException
{
    /**
     * @var string Winner disk
     */
    private $disk;

    /**
     * @return string
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * @param string $disk
     */
    public function setDisk($disk)
    {
        $this->disk = $disk;
    }
}
