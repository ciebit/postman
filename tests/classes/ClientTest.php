<?php
namespace Ciebit\Postman\Test;

use Ciebit\Postman\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /** @var string */
    public const ID = '1';

    /** @var string */
    public const NAME = 'John';

    public static function getInstance(): Client
    {
        return new Client(self::NAME, self::ID);
    }

    public function testCreate(): void
    {
        $client = $this->getInstance();
        $this->assertEquals(self::NAME, $client->getName());
        $this->assertEquals(self::ID, $client->getId());
    }
}