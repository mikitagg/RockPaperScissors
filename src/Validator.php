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
            $this->error[] = "All moves must be distinct \n";
        }
        if (count($input) <= 3) {
            $this->error[] = "Please enter at least 3 moves \n";
        }
        if (count($input)%2 != 0) {
            $this->error[] = "Please enter odd move number. \n";
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