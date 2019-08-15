<?php
namespace Ciebit\Postman;

use Ciebit\Postman\Addressee\Technology;
use Ciebit\Postman\Authentication;
use Ciebit\Postman\Message;
use Ciebit\Postman\Package\Package;
use Ciebit\Postman\Package\Status;
use Ciebit\Postman\Package\Storages\Storage;

class Postman
{
    /** @var Authentication */
    private $authentication;

    /** @var Storage */
    private $storage;

    public function __construct(Storage $storage, Authentication $authentication)
    {
        $this->authentication = $authentication;
        $this->storage = $storage;
    }

    public function add(Message $message, Technology $technology): self
    {
        $package = new Package($message, Status::PENDING(), $technology, '', '');
        $this->storage->store($package);
        return $this;
    }
}