<?php

namespace Bender\Itransition3;

class Validator
{
    private array $error;
    public function __construct(array $input)
    {
        $this->validate($input);
    }

    private function validate(array $input): void
    {
        if (count(array_unique($input)) !== count($input)) {
            $this->error[] = "Please enter unique values \n";
        }
        if (count($input) <= 3) {
            $this->error[] = "Please enter at least 3 values \n";
        }
        if (count($input)%2 != 0) {
            $this->error[] = "Please enter %2 values \n";
        }
    }

    public function isPassed(): bool
    {
        return (bool)empty($this->error);
    }

    public function getError(): array
    {
        return $this->error;
    }
}