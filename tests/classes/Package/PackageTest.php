<?php
namespace Ciebit\Postman\Test\Package;

use Ciebit\Postman\Message;
use Ciebit\Postman\Package\Package;
use Ciebit\Postman\Package\Status;
use Ciebit\Postman\Test\Addressee\BuilderTest;
use Ciebit\Postman\Test\MessageTest;
use DateTime;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /** @var string */
    private const CLIENT_ID = '123';

    /** @var string */
    private const DATE_TIME = '2019-08-15 11:43:45';

    /** @var string */
    private const ID = '45';

    /** @var int */
    private const STATUS = Status::PENDING;

    public static function getInstance(): Package
    {
        return new Package(
            MessageTest::getInstance(),
            new Status(self::STATUS),
            BuilderTest::getInstance(),
            self::CLIENT_ID,
            self::ID,
            new DateTime(self::DATE_TIME)
        );
    }

    public function testCreation(): void
    {
        $package = self::getInstance();

        $this->assertEquals(self::CLIENT_ID, $package->getClientId());
        $this->assertEquals(self::DATE_TIME, $package->getDateTime()->format('Y-m-d H:i:s'));
        $this->assertEquals(self::ID, $package->getId());
        $this->assertInstanceOf(Message::class, $package->getMessage());
        $this->assertEquals(self::STATUS, $package->getStatus()->getValue());
    }
}
