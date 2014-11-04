<?php
use DreamCommerce\Client;
use DreamCommerce\Exceptions\ClientException;
use DreamCommerce\Exceptions\ResourceException;

require 'Config.php';

try {

    // set custom retries count
    // it will throw HttpException if the limit is too low
    //DreamCommerce\Http::setRetryLimit(2);

    $client = new DreamCommerce\Client(
        'http://example.com', Config::APPID, Config::APP_SECRET
    );

    $client->setAccessToken('<INSERT TOKEN HERE>');

    $resource = $client->producers;
    // or
    //$resource = new \DreamCommerce\Resource($client, 'producers');

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