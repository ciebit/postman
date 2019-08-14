<?php
namespace Ciebit\Postman\Package;

use MyCLabs\Enum\Enum;

class Status extends Enum
{
    const ERROR = 3;
    const FAILURE = 2;
    const PENDING = 1;
    const SENT = 4;
}
