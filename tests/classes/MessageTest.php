<?php
namespace Ciebit\Postman\Test;

use Ciebit\Postman\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testCreate(): void
    {
        $message = new Message('hello');
        $this->assertEquals('hello', $message->getContent());
        $this->assertEquals('hello', $message);
    }
}