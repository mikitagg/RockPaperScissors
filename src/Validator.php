<?php

namespace Bender\Itransition3;

class Validator
{
    protected array $error;
    protected bool $isPassed = true;
    public function validate(array $input): void
    {
        if (count(array_unique($input)) !== count($input)) {
            $this->error[] = "Please enter unique values \n";
            $this->isPassed = false;
        }
        if (count($input) <= 3) {
            $this->error[] = "Please enter at least 3 values \n";
            $this->isPassed = false;
        }
        if (count($input)%2 != 0) {
            $this->error[] = "Please enter %2 values \n";
            $this->isPassed = false;
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