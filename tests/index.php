<?php

use Ciebit\Postman\Addressess\Mail;
use Ciebit\Postman\Message;
use Ciebit\Postman\Postman;

$client = new Client($keyPublic, $keySecret);
$postman = new Postman($client);

$message = new Message('Olá');
$technology = new Mail('joao@ciebit.com', 'João');

$postman->add($message, $technology);