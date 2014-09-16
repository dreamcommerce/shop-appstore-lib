<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 10:19
 */

require '../vendor/autoload.php';

class SomeApplicationController{

    /**
     * @var null|Dreamcommerce\Handler
     */
    protected $handler = null;

    protected function getDatabaseConnection(){
        static $connection = null;

        if(!$connection){
            $connection = new PDO('mysql:host=localhost;dbname=test', 'username', 'password');
        }

        return $connection;
    }

    public function __construct(){

        $handler = $this->handler = new Dreamcommerce\Handler(123,123);

        $handler->subscribe('install', array($this, 'installHandler'));
        $handler->subscribe('billing_install', array($this, 'billingInstallHandler'));
        $handler->subscribe('billing_subscription', array($this, 'billingSubscriptionHandler'));
        $handler->subscribe('uninstall', array($this, 'uninstallHandler'));

    }

    public function dispatch(){
        try{
            $this->handler->dispatch();
        }catch(\Dreamcommerce\Exceptions\HandlerException $ex){
            if($ex->getCode()==\Dreamcommerce\Exceptions\HandlerException::HASH_FAILED){
                die('Payload hash verification failed');
            }
        }catch(Exception $ex){
            die($ex->getMessage());
        }
    }

    public function installHandler($arguments){
        try{
            $arguments['client']->refreshToken();
        }catch(\Dreamcommerce\Exceptions\ClientException $ex){
            die('Ooops, something went wrong');
        }

        $arguments['action'];

        $arguments['shop'];
        $arguments['shop_url'];
        $arguments['application_code'];
        $arguments['auth_code'];
        $arguments['hash'];
        $arguments['timestamp'];
    }

    public function billingInstallHandler($arguments){

        $arguments['action'];
        $arguments['shop'];
        $arguments['shop_url'];
        $arguments['application_code'];
        $arguments['hash'];
        $arguments['timestamp'];
    }

    public function uninstallHandler($arguments){
        $arguments['action'];

        $arguments['shop'];
        $arguments['shop_url'];
        $arguments['application_code'];
        $arguments['hash'];
        $arguments['timestamp'];
    }

    public function billingSubscriptionHandler($arguments){
        $arguments['action'];
        $arguments['shop'];
        $arguments['shop_url'];
        $arguments['application_code'];
        $arguments['subscription_end_time'];
        $arguments['hash'];
        $arguments['timestamp'];
    }

}

$controller = new SomeApplicationController();
$controller->dispatch();