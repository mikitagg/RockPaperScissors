<?php

namespace Bender\Itransition3;

class UIHelper
{

    const ERROR_MESSAGE = "The number of moves is invalid.\n";

    const HELP_MESSAGE = "Please enter a move from the moves provided above.\nTo end the game, enter 0 ";
    public function __construct()
    {
    }

    public function message($moves)
    {
        echo self::ERROR_MESSAGE;
        $select = $this->getLine();
        return $this->selectValues($select, $moves);
    }

    public function help($moves)
    {
        echo self::HELP_MESSAGE;
        $select = $this->getLine();
        return $this->selectValues($select, $moves);
    }

    public function selectValues($select, $moves)
    {
        if ((int)$select < 0 || (int)$select > count($moves)) {
            return $this->message($moves);
        }
        return match ($select) {
            '0' => die,
            '?' => $this->help($moves),
            default => $select,
        };
    }

    private function getLine(): string
    {
        return readline("Enter your move:");
    }

    public function gameResult(int $res)
    {
        if($res < 0)
        {
            return "\nYou Lose! \n";
        }
        if ($res > 0)
        {
            return "\nYou Win! \n";
        }
        return "\nDraw! \n";
    }

}