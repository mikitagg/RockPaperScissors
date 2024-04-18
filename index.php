<?php

require 'vendor/autoload.php';

use Bender\Itransition3\Validator;
use LucidFrame\Console\ConsoleTable;
use Bender\Itransition3\Table;
use Bender\Itransition3\Generator;
use Bender\Itransition3\Formula;

function message($moves)
{
    echo "\n Please enter valid values \n";
    $select = readline("Enter your code:");
    return selectValues($select, $moves);
}

function help($moves)
{
    echo "\n Please enter value from the menu \n";
    $select = readline("Enter your code:");
    return selectValues($select, $moves);
}

function selectValues($select, $moves)
{
    if ($select <= 0 || $select >= count($moves)) {
        return message($moves);
    }
    return match ($select) {
        '0' => die,
        '?' => help($moves),
        default => $select,
    };
}


$formula = new Formula();
$table = new ConsoleTable();
$customTable = new Table($table, $formula);
$hmac = new Generator();
$validate = new Validator();

$validate->validate($argv);

if (!$validate->isPassed())
{
    echo implode('', $validate->getError());
    die;
}

$args = array_slice($argv, 1);

$keyValues = range(1, count($args));
$moves = array_combine($keyValues, $args);

$customTable->create($moves);
$customTable->displayTable();

$compMove = rand(0, count($moves));

$hmac->generate($compMove);

echo $hmac->getHmac();

$menu = $moves + ['0' => 'exit', '?' => 'help'];

foreach($menu as $key=>$value) {
    echo "\n".$key.": ".$value;
}
echo "\n";

$select = readline("Enter your code:");

$userMove = selectValues($select, $moves);


echo "\n";

echo $compMove;

$res = $formula->formula($moves, $userMove, $compMove);

if($res == 0) {
    echo "\n Draw\n";
} elseif($res > 0) {
    echo "\n You Win\n";
} else {
    echo "\n You Lose \n";
}
