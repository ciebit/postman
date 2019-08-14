<?php
namespace Ciebit\Postman;

use Ciebit\Postman\Addressee\Tecnology;
use Ciebit\Postman\Message;
use Ciebit\Postman\Package\Package;
use Ciebit\Postman\Package\Status;

class Postman
{
    public function __construct()
    {
        
    }

    public function add(Message $message, Tecnology $tecnology): self
    {
        $package = new Package($message, Status::PENDING(), $tecnology, '');
        return $this;
    }
}