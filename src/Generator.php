<?php

namespace Bender\Itransition3;

class Generator
{

    private string $hmac;

    private string $salt;

    public function __construct()
    {
        $this->salt = $this->generateRandomBytes();
    }

    public function generate(int $move): void
    {
        $this->hmac = hash_hmac('sha3-256', hash('sha3-256', $move), $this->salt);
    }

    public function generateRandomBytes(): string
    {
        return openssl_random_pseudo_bytes(64);
    }

    public function getHmac(): string
    {
        return $this->hmac;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }
}