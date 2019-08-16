<?php
namespace Ciebit\Postman\Test;

use Ciebit\Postman\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /** @var string */
    public const CONTENT = 'hello';

    public static function getInstance(): Message
    {
        return new Message(self::CONTENT);
    }

    public function testCreate(): void
    {
        $message = self::getInstance();
        $this->assertEquals(self::CONTENT, $message->getContent());
        $this->assertEquals(self::CONTENT, $message);
    }
}