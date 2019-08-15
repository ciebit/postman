<?php
namespace Ciebit\Postman\Addressee;

use Ciebit\Postman\Addressee\Technology;
use Ciebit\Postman\Message;
use PHPMailer\PHPMailer\PHPMailer;

class Mail implements Technology 
{
    /** @var string */
    private $address;

    /** @var string */
    private $name;

    public function __construct(
        string $address,
        string $name
    ) {
        $this->address = $address;
        $this->name = $name;
    }

    public function jsonSerialize(): array
    { 
        return [
            'type' => Mail::class,
            'address' => $this->address,
            'name' => $this->name
        ];
    }

    public function send(Message $message): bool
    {
        $mail = new PHPMailer;
        
        return true;
    }
}