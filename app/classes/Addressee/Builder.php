<?php
namespace Ciebit\Postman\Addressee;

use Ciebit\Postman\Addressee\Addressee;
use Ciebit\Postman\Addressee\Mail;
use Ciebit\Postman\Exception;

class Builder
{
    /**
     * @throws Exception
     */
    public static function build(array $data): Addressee
    {
        if (! isset($data['type'])) {
            throw new Exception('ciebit.postman.addressee.builder', 3);
        }

        switch ($data['type']) {
            case Mail::class:
                return new Mail(
                    $data['address'] ?? '',
                    $data['name'] ?? ''
                );
        }
    }
}