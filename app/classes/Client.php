<?php
namespace Ciebit\Postman;

class Client
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    public function __construct(
        string $name,
        string $id
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
