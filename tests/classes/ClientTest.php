<?php
namespace Ciebit\Postman\Test;

use Ciebit\Postman\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testCreate(): void
    {
        $client = new Client('Johnny', '1');
        $this->assertEquals('Johnny', $client->getName());
        $this->assertEquals('1', $client->getId());
    }
}