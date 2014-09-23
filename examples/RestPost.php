<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2014-09-22
 * Time: 09:11
 */

require '../vendor/autoload.php';
require 'config.php';

try {
    $c = new Dreamcommerce\Client(
        Config::ENTRYPOINT, Config::APPID, Config::APP_SECRET
    );

    $c->setAccessToken('3198a753da3418420987319f883ba2260ceb3bf7');
    $req = $c->producer;

    $insertedId = $req->post(array(
        'name'=>'Awesome Manufacturer!',
        'web'=>'http://example.org'
    ));

    printf("Added object, #%d", $insertedId);


}catch(ClientException $ex){
    printf("An error occurred during the Client initialization: %s", $ex->getMessage());
}catch(ResourceException $ex){
    printf("An error occurred during Resource access: %s", $ex->getMessage());
}