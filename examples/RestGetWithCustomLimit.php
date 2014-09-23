<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2014-09-22
 * Time: 09:11
 */

use Dreamcommerce\Exceptions\ResourceException;

require '../vendor/autoload.php';
require 'config.php';

try {

    // it will throw HttpException if the limit is too low
    Dreamcommerce\Http::setRetryLimit(2);

    $c = new Dreamcommerce\Client(
        Config::ENTRYPOINT, Config::APPID, Config::APP_SECRET
    );

    $c->setAccessToken('3198a753da3418420987319f883ba2260ceb3bf7');
    $req = $c->producer;
    $list = $req->get();


    printf("Found: %d\n", $list->count);
    printf("Page: %d of %d\n", $list->page, $list->pages);

    printf("Iterating over producers:\n");
    foreach($list as $i){
        printf("#%d - %s (%s)\n", $i['producer_id'], $i['name'], $i['web']);
    }


}catch(ClientException $ex){
    printf("An error occurred during the Client initialization: %s", $ex->getMessage());
}catch(ResourceException $ex){
    printf("An error occurred during Resource access: %s", $ex->getMessage());
}