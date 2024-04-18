<?php

namespace Bender\Itransition3;

class UIHelper
{

    const ERROR_MESSAGE = "The number of moves is invalid.\n";
    const KEYBOARD_MESSAGE = "Enter your move:\n";
    const HELP_MESSAGE = "Please enter a move from the moves provided above.\nTo end the game, enter 0. ";
    const DRAW_MESSAGE = "\nDraw! \n";
    const LOSE_MESSAGE = "\nYou Lose! \n";
    const WIN_MESSAGE = "\nYou Win! \n";

    private array $menu;

    private array $moves;

    public function __construct(array $args)
    {
        $this->moves = $this->createMoves($args);
        $this->menu = $this->createMenu();
    }

    public function message($moves, $cliMessage)
    {
        echo $cliMessage;
        return $this->selectValues($moves);
    }

    public function selectValues($moves)
    {
        $select = readline(self::KEYBOARD_MESSAGE);
        if ((int)$select < 0 || (int)$select > count($moves)) {
            return $this->message($moves, self::ERROR_MESSAGE);
        }
        return match ($select) {
            '0' => die,
            '?' => $this->message($moves, self::HELP_MESSAGE),
            default => $select,
        };
    }

    public function gameResult(int $res): string
    {
        if($res < 0)
        {
            return self::LOSE_MESSAGE;
        }
        if ($res > 0)
        {
            return self::WIN_MESSAGE;
        }
        return self::DRAW_MESSAGE;
    }

    public function displayMenu(): void
    {
        foreach($this->menu as $key=>$value) {
            echo "\n".$key." - ".$value;
        }
    }

    public function getMoves(): array
    {
        return $this->moves;
    }

    private function createMenu(): array
    {
       return $this->moves + ['0' => 'exit', '?' => 'help'];
    }

    private function createMoves(array $args): array
    {
        $args = array_slice($args, 1);
        return array_combine(range(1, count($args)), $args);
    }


}