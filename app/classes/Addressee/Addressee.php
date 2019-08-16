<?php
namespace Ciebit\Postman\Addressee;

use Ciebit\Postman\Message;
use JsonSerializable;

interface Addressee extends JsonSerializable
{
    public function send(Message $message): bool;
}
