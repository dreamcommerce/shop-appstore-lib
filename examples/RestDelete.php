<?php
use DreamCommerce\Client;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\ResourceException;

$config = require 'Config.php';

try {
    $client = new Client(
        'http://example.com', $config['appId'], $config['appSecret']
    );

    $client->setAccessToken('INSERT TOKEN HERE');

    $resource = new \DreamCommerce\Resource\Producer($client);
    // or
    //$resource = $client->producers;

    $result = $resource->delete(41);

    printf("An object was successfully deleted");

} catch (ClientException $ex) {
    printf("An error occurred during the Client initialization: %s", Client::getError($ex));
} catch (ResourceException $ex) {
    printf("An error occurred during Resource access: %s", Client::getError($ex));
}