<?php
namespace Ciebit\Postman\Package;

use Ciebit\Postman\Addressee\Addressee;
use Ciebit\Postman\Message;
use Ciebit\Postman\Package\Status;
use DateTime;

use function date;

class Package
{
    /** @var Addressee */
    private $addressee;

    /** @var string */
    private $clientId;

    /** @var DateTime */
    private $dateTime;

    /** @var string */
    private $id;

    /** @var Message */
    private $message;
    
    /** @var Status */
    private $status;

    public function __construct(
        Message $message,
        Status $status,
        Addressee $addressee,
        string $clientId,
        string $id,
        DateTime $dateTime = null
    ) {
        $this->addressee = $addressee;
        $this->clientId = $clientId;
        $this->dateTime = $dateTime ?? new DateTime(date('Y-m-d H:i:s'));
        $this->id = $id;
        $this->message = $message;
        $this->status = $status;
    }

    public function getAddressee(): Addressee
    {
        return $this->addressee;
    }

    public function getClientId(): string
    {
        return $this->clientId;
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
}