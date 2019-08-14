<?php
namespace Ciebit\Postman\Addressee;

use Ciebit\Postman\Message;
use JsonSerializable;

interface Technology extends JsonSerializable
{
    public function send(Message $message): bool;
}
