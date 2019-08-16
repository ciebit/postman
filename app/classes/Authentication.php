<?php
namespace Ciebit\Postman;

class Authentication
{
    /** @var string */
    private $privateKey;

    /** @var string */
    private $publicKey;

    public function __construct(
        string $publicKey,
        string $privateKey
    ) {
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
    }

    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }
}
