<?php
use DreamCommerce\Client;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\ResourceException;

$config = require 'Config.php';

try {

    // set custom retries count
    // it will throw HttpException if the limit is too low
    //DreamCommerce\Http::setRetryLimit(2);

    $client = new Client(
        'http://55.dev', $config['appId'], $config['appSecret']
    );

    $client->setAccessToken('INSERT TOKEN HERE');

    $resource = new \DreamCommerce\Resource\Producer($client);
    // or
    //$resource = $client->producers;

    $result = $resource->get();

    // particular object, with ID=1
    //$result = $resource->get(1);

    // particular subobject with param=1, ID=1
    //$result = $resource->get('some', 1);

    // or with filtering/limiting:
    //$result = $resource->filter(array('name'=>'not null'))->page(3)->limit(10)->get();

    printf("Found: %d\n", $result->count);
    printf("Page: %d of %d\n", $result->page, $result->pages);

    printf("Iterating over producers:\n");

    foreach ($result as $i) {
        printf("#%d - %s (%s)\n", $i->producer_id, $i->name, $i->web);
        // or - for your convenience:
        //printf("#%d - %s (%s)\n", $i['producer_id'], $i['name'], $i['web']);
    }


} catch (ClientException $ex) {
    printf("An error occurred during the Client initialization: %s", Client::getError($ex));
} catch (ResourceException $ex) {
    printf("An error occurred during Resource access: %s", Client::getError($ex));
}