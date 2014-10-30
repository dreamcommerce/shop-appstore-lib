<?php
use DreamCommerce\Exceptions\ClientException;
use DreamCommerce\Exceptions\ResourceException;

require 'config.php';

try {
    $client = new DreamCommerce\Client(
        'http://example.com', Config::APPID, Config::APP_SECRET
    );

    $client->setAccessToken('<INSERT TOKEN HERE>');

    $resource = $client->producers;
    // or
    //$resource = new \DreamCommerce\Resource($client, 'producers');

    $result = $resource->delete(41);

    printf("An object was successfully deleted");

} catch (ClientException $ex) {
    printf("An error occurred during the Client initialization: %s", $ex->getMessage());
} catch (ResourceException $ex) {
    printf("An error occurred during Resource access: %s", $ex->getMessage());
}