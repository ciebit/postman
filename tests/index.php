<?php

use Ciebit\Postman\Authentication;
use Ciebit\Postman\Addressee\Mail;
use Ciebit\Postman\Message;
use Ciebit\Postman\Postman;
use Ciebit\Postman\Package\Storages\Sql;

$authentication = new Authentication($keyPublic, $keySecret);
$storage = new Sql(new PDO(''));
$postman = new Postman($storage, $authentication);

$message = new Message('Olá');
$technology = new Mail('joao@ciebit.com', 'João');

$postman->add($message, $technology);