<?php

namespace Bender\Itransition3;

class Generator
{

    private string $hmac;

    private string $key;

    public function __construct()
    {
        $this->key = $this->generateRandomBytes();
    }

    public function generate(int $move): void
    {
        $this->hmac = hash_hmac('sha3-256', hash('sha3-256', $move), $this->key);
    }

    public function generateRandomBytes(): string
    {
        return random_bytes(32);
    }

    public function getHmac(): string
    {
        return $this->hmac;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}