<?php

require 'vendor/autoload.php';

use Bender\Itransition3\UIHelper;
use Bender\Itransition3\Validator;
use LucidFrame\Console\ConsoleTable;
use Bender\Itransition3\Table;
use Bender\Itransition3\Generator;
use Bender\Itransition3\Formula;

if(empty($argv[1])) {
    die;
}

$formula = new Formula();
$table = new ConsoleTable();
$customTable = new Table($table, $formula);
$hmac = new Generator();
$validate = new Validator($argv);
$uiHelper = new UIHelper($argv);

if (!$validate->isPassed())
{
    echo implode('', $validate->getError());
    die;
}

$moves = $uiHelper->getMoves();

$customTable->create($moves)->displayTable();

$compMove = rand(1, count($moves));

$hmac->generate($compMove);

echo "HMAC: " . $hmac->getHmac();

$uiHelper->displayMenu();

echo "\n";

$userMove = $uiHelper->selectValues($moves);

echo $moves[$userMove] . "\n";

echo "Computer move: " . $moves[$compMove];

$res = $formula->formula($moves, $userMove, $compMove);

echo $uiHelper->gameResult($res);

echo "HMAC key: " . bin2hex($hmac->getKey()) . "\n";