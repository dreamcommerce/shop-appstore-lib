<?php
use DreamCommerce\Exception\ClientException;

require '../vendor/autoload.php';

$config = require 'Config.php';

try {
    $c = new DreamCommerce\Client('http://example.com', $config['appId'], $config['appSecret']);
    $token = $c->refreshToken('INSERT TOKEN HERE');

    printf("Token has been successfully refreshed");

} catch (ClientException $ex) {
    printf("An error occurred during the Client request: %s", $ex->getMessage());
}