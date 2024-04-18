<?php

namespace Bender\Itransition3;

use LucidFrame\Console\ConsoleTable;
use Bender\Itransition3\Formula;

class Table
{
    private ConsoleTable $table;

    private Formula $formula;

    public function __construct(ConsoleTable $table, Formula $formula)
    {
        $this->table = $table;
        $this->formula = $formula;
    }

    public function create(array $args): void
    {

        $this->table->addHeader('PC/USER');

        for($i = 1; $i < count($args)+1; $i++){
            $this->table->addHeader($args[$i])->addRow()->addColumn($args[$i]);
            for($j = 1; $j < count($args)+1; $j++){
                $ans = $this->formula->formula($args, $j, $i);
                if($ans == 0) {
                    $this->table->addColumn('Draw');
                    continue;
                }
                if ($ans > 0) {
                    $this->table->addColumn('Win');
                    continue;
                }
                    $this->table->addColumn('Lose');

            }
        }
    }

    public function displayTable(): void
    {
        $this->table->display();
    }
}
