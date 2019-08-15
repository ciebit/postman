<?php
namespace Ciebit\Postman;

class Authentication
{
    /** @var string */
    private $keyPublic;

    /** @var string */
    private $keySecret;

    public function __construct(
        string $keyPublic,
        string $keySecret
    ) {
        $this->keyPublic = $keyPublic;
        $this->keySecret = $keySecret;
    }

    public function getKeyPublic(): string
    {
        return $this->keyPublic;
    }

    public function getKeySecret(): string
    {
        return $this->keySecret;
    }
}
