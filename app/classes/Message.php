<?php
namespace Ciebit\Postman;

class Message
{
    /** @var string */
    private $message;

    public function __construct(
        string $message
    ) {
        $this->message = $message;
    }

    public function getContent(): string
    {
        return $this->message;
    }
}