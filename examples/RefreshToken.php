<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2014-09-18
 * Time: 13:31
 */

use Dreamcommerce\Exceptions\ClientException;

require '../vendor/autoload.php';

try {
    $c = new Dreamcommerce\Client(Config::ENTRYPOINT, Config::APPID, Config::APP_SECRET);
    $token = $c->refreshToken('f35a2c3092127033f76e6c1e23d676f5e33ca55e');

    printf("Token has been successfully refreshed");

}catch(ClientException $ex){
    printf("An error occurred during the Client request: %s", $ex->getMessage());
}