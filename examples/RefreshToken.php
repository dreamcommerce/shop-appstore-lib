<?php
use DreamCommerce\Exceptions\ClientException;

require '../vendor/autoload.php';

try {
    $c = new DreamCommerce\Client(Config::ENTRYPOINT, Config::APPID, Config::APP_SECRET);
    $token = $c->refreshToken('<INSERT TOKEN HERE>');

    printf("Token has been successfully refreshed");

} catch (ClientException $ex) {
    printf("An error occurred during the Client request: %s", $ex->getMessage());
}