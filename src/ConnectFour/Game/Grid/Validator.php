<?php

namespace ConnectFour\Game\Grid;

use ConnectFour\Game;
use ConnectFour\Game\Exception\EndGameException;
use ConnectFour\Game\Exception\WinnerException;
use ConnectFour\Game\Grid;

/**
 * This class validates given grid
 */
class Validator
{

    /**
     * @param array $line
     * @throws WinnerException
     */
    public static function testLine($line)
    {
        if (count($line) < Game::COUNT_DISK_TO_WIN) {
            return;
        }

        $count = 0;
        $disk = null;

        foreach ($line as $item) {
            if ($item) {
                if ($disk != $item) {
                    $count = 0;
                }
                $disk = $item;
                $count++;
            } else {
                $count = 0;
                $disk = null;
            }
            if ($count >= Game::COUNT_DISK_TO_WIN) {
                $ex = new WinnerException();
                $ex->setDisk($disk);
                throw $ex;
            }
        }
    }

    /**
     * Validate if game is not ended
     *
     * @param Grid $grid
     * @throws EndGameException
     */
    public static function validate(Grid $grid)
    {
        $raw = $grid->getRepresentation();

        for ($i = 0; $i < count($raw[0]); $i++) {
            self::testLine(Helper::getColumn($raw, $i));
        }

        for ($i = 0; $i < count($raw); $i++) {
            self::testLine(Helper::getRow($raw, $i));
        }

        for ($i = 0; $i < count($raw[0]); $i++) {
            self::testLine(Helper::getDiagonally($raw, [0, $i], [1, 1]));
            self::testLine(Helper::getDiagonally($raw, [0, $i], [1, -1]));
            self::testLine(Helper::getDiagonally($raw, [count($raw[0]), $i], [-1, 1]));
            self::testLine(Helper::getDiagonally($raw, [count($raw[0]), $i], [-1, -1]));
        }

        for ($i = 0; $i < count($raw); $i++) {
            self::testLine(Helper::getDiagonally($raw, [$i, 0], [-1, 1]));
            self::testLine(Helper::getDiagonally($raw, [$i, 0], [1, 1]));
            self::testLine(Helper::getDiagonally($raw, [$i, count($raw)], [-1, -1]));
            self::testLine(Helper::getDiagonally($raw, [$i, count($raw)], [1, -1]));
        }

        if (Helper::isFull($raw)) {
            throw new EndGameException('Grid is full');
        }
    }
}
