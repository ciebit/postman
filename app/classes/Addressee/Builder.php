<?php
namespace Ciebit\Postman\Addressee;

use Ciebit\Postman\Addressee\Technology;
use Ciebit\Postman\Addressee\Mail;

class Builder
{
    public static function build(array $data): Technology
    {
        if (! isset($data['type'])) {

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