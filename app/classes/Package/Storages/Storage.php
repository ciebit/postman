<?php
namespace Ciebit\Postman\Package\Storages;

use Ciebit\Postman\Exception;
use Ciebit\Postman\Package\Collection;
use Ciebit\Postman\Package\Package;

interface Storage
{
    /**
     * @throws Exception
     */
    public function find(): Collection;

    /**
     * @throws Exception
     */
    public function store(Package $message): Package;
}
