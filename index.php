<?php

require 'vendor/autoload.php';

use Bender\Itransition3\UIHelper;
use Bender\Itransition3\Validator;
use LucidFrame\Console\ConsoleTable;
use Bender\Itransition3\Table;
use Bender\Itransition3\Generator;
use Bender\Itransition3\Formula;

$formula = new Formula();
$table = new ConsoleTable();
$customTable = new Table($table, $formula);
$hmac = new Generator();
$validate = new Validator($argv);
$uiHelper = new UIHelper();

if (!$validate->isPassed())
{
    echo implode('', $validate->getError());
    die;
}

$args = array_slice($argv, 1);

$moves = array_combine(range(1, count($args)), $args);

$customTable->create($moves)->displayTable();

$compMove = rand(1, count($moves));

$hmac->generate($compMove);

echo "HMAC: " . $hmac->getHmac();

$menu = $moves + ['0' => 'exit', '?' => 'help'];

foreach($menu as $key=>$value) {
    echo "\n".$key." - ".$value;
}

echo "\n";

$select = readline("Enter your move:");


$userMove = $uiHelper->selectValues($select, $moves);

echo $moves[$userMove] . "\n";

echo "Computer move: " . $moves[$compMove];

$res = $formula->formula($moves, $userMove, $compMove);

echo $uiHelper->gameResult($res);

echo "HMAC key: " . bin2hex($hmac->getKey()) . "\n";