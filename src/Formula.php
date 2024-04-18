<?php

namespace Bender\Itransition3;

class Formula
{
    public function formula(array $args, int $userMove, int $cpMove): int
    {
         return ($userMove - $cpMove + count($args) + floor(count($args)/2)) % count($args) - floor(count($args)/2);
    }
}