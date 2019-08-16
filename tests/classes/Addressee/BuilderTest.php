<?php
namespace Ciebit\Postman\Test\Addressee;

use Ciebit\Postman\Addressee\Addressee;
use Ciebit\Postman\Addressee\Builder;
use Ciebit\Postman\Addressee\Mail;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /** @var string */
    private const ADDRESS = 'john@mail.com';
    
    /** @var string */
    private const NAME = 'John Max';

    /** @var string */
    private const TYPE = Mail::class;

    public static function getInstance(): Addressee
    {
        return Builder::build([
            'type' => self::TYPE,
            'address' => self::ADDRESS,
            'name' => self::NAME
        ]);
    }

    public function testCreation(): void
    {
        $addressee = self::getInstance();
        $this->assertInstanceOf(Addressee::class, $addressee);
    }
}
