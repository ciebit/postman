<?php
namespace Ciebit\Postman\Test;

use Ciebit\Postman\Authentication;
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase
{
    /** @var string */
    private const KEY_PRIVATE = 'key-private';

    /** @var string */
    private const KEY_PUBLIC = 'key-public';

    public function testCreate(): void
    {
        $authentication = new Authentication(self::KEY_PUBLIC, self::KEY_PRIVATE);
        $this->assertEquals(self::KEY_PRIVATE, $authentication->getPrivateKey());
        $this->assertEquals(self::KEY_PUBLIC, $authentication->getPublicKey());
    }
}