<?php
namespace Ciebit\Postman\Package;

use Ciebit\Postman\Addressee\Technology;
use Ciebit\Postman\Message;
use Ciebit\Postman\Package\Status;
use DateTime;

use function date;

class Package
{
    /** @var DateTime */
    private $dateTime;

    /** @var string */
    private $id;

    /** @var Message */
    private $message;
    
    /** @var Status */
    private $status;

    /** @var Technology */
    private $technology;

    public function __construct(
        Message $message,
        Status $status = null,
        Technology $technology,
        string $id
    ) {
        $this->dateTime = new DateTime(date('Y-m-d H:i:s'));
        $this->id = $id;
        $this->message = $message;
        $this->status = $status;
        $this->technology = $technology;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getTechnology(): Technology
    {
        return $this->technology;
    }
}