<?php

namespace Bender\Itransition3;

use Bender\Itransition3\Table;

class UIHelper
{

    const ERROR_MESSAGE = "The number of moves is invalid.\n";
    const KEYBOARD_MESSAGE = "Enter your move:\n";
    const DRAW_MESSAGE = "\nDraw! \n";
    const LOSE_MESSAGE = "\nYou Lose! \n";
    const WIN_MESSAGE = "\nYou Win! \n";

    private array $menu;

    private array $moves;

    private Table $table;

    public function __construct(array $args, Table $table)
    {
        $this->moves = $this->createMoves($args);
        $this->menu = $this->createMenu();
        $this->table = $table;
    }

    public function printErrorMessage(array $moves)
    {
        echo self::ERROR_MESSAGE;
        return $this->selectValues($moves);
    }

    public function showTable()
    {
        $this->table->create($this->moves)->displayTable();
        return $this->selectValues($this->moves);
    }

    public function selectValues(array $moves)
    {
        $select = readline(self::KEYBOARD_MESSAGE);
        if ((int)$select < 0 || (int)$select > count($moves)) {
            return $this->printErrorMessage($moves);
        }
        return match ($select) {
            '0' => die,
            '?' => $this->showTable(),
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