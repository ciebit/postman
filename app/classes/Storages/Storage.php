<?php
namespace Ciebit\Postman\Storages;

use Ciebit\Postman\Package\Package;

interface Storage
{
    public function store(Package $message): Package;
}
