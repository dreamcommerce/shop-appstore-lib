<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 11:03
 */

namespace Dreamcommerce;


use Dreamcommerce\Exceptions\ClientException;
use Dreamcommerce\Exceptions\HandlerException;

/**
 * server response handler
 * @package Dreamcommerce
 */
class Handler {

    /**
     * registered handlers for a particular actions
     * @var array
     */
    protected $events = array();
    /**
     * existing API actions
     * @var array
     */
    protected $eventsMap = array(
        'install', 'uninstall', 'billing_install', 'billing_subscription'
    );

    /**
     * @var null|string
     */
    protected $clientId = null;
    /**
     * @var null|string
     */
    protected $clientSecret = null;

    /**
     * @var null|string
     */
    protected $appStoreSecret = null;

    /**
     * application requests object
     * @var Client
     */
    protected $client = null;

    /**
     * application entrypoint
     * @var null|string
     */
    protected $entrypoint = null;

    /**
     * @param string $entrypoint
     * @param string $clientId
     * @param string $secret
     * @param string $appStoreSecret
     * @throws HandlerException
     */
    public function __construct($entrypoint, $clientId, $secret, $appStoreSecret){
        $this->clientId = $clientId;
        $this->clientSecret = $secret;
        $this->entrypoint = $entrypoint;
        $this->appStoreSecret = $appStoreSecret;

        try {
            $this->client = new Client($entrypoint, $clientId, $secret);
        }catch(ClientException $ex){
            throw new HandlerException('', HandlerException::CLIENT_INITIALIZATION_FAILED, $ex);
        }
    }

    /**
     * request dispatcher
     * @param array|null $requestBody if null - uses $_POST
     * @throws Exceptions\HandlerException
     */
    public function dispatch($requestBody = null){

        if($requestBody===null){
            $requestBody = $_POST;
        }

        if(empty($requestBody)){
            throw new HandlerException('', HandlerException::PAYLOAD_EMPTY);
        }

        // no action specified?
        if(empty($requestBody['action'])){
            throw new HandlerException('', HandlerException::ACTION_NOT_EXISTS);
        }

        $this->actionExists($requestBody['action']);

        $this->verifyPayload($requestBody);

        // fire handlers for specified actions
        $this->fire($requestBody['action'], $requestBody);

    }

    /**
     * verifies a payload against provided data hash value
     * @param $payload
     * @return bool
     * @throws Exceptions\HandlerException
     */
    protected function verifyPayload($payload){

        $providedHash = $payload['hash'];
        unset($payload['hash']);

        // sort params
        ksort($payload);

        $processedPayload = "";

        foreach($payload as $k => $v){
            $processedPayload .= '&'.$k.'='.$v;
        }

        $processedPayload = substr($processedPayload, 1);

        $computedHash = hash_hmac('sha512', $processedPayload, $this->appStoreSecret);

        if($computedHash!=$providedHash){
            throw new HandlerException('', HandlerException::HASH_FAILED);
        }

        return true;
    }

    /**
     * checks whether handled action really exists in API
     * @param $action
     * @return bool
     * @throws Exceptions\HandlerException
     */
    protected function actionExists($action){
        if(!in_array($action, $this->eventsMap)){
            throw new HandlerException('', HandlerException::ACTION_NOT_EXISTS);
        }

        return true;
    }

    /**
     * fires handlers for a specific action
     * @param $action
     * @param $params
     * @throws Exceptions\HandlerException
     */
    protected function fire($action, $params){

        if(!isset($this->events[$action])){
            throw new HandlerException('', HandlerException::ACTION_HANDLER_NOT_EXISTS);
        }

        // prepare params array for handler
        // we provide a client library as a param for further requests
        $callbackParams = $params;
        $callbackParams['client'] = $this->client;

        // fire handlers for every event
        foreach($this->events[$action] as $e){
            $result = call_user_func($e, $callbackParams);
            if(!$result){
                break;
            }
        }

    }

    /**
     * unsubscribes event for an action
     * @param $event
     * @param Callable|null $handler if null - drops all handlers; if handler specified - drops only this one
     * @return bool
     */
    public function unsubscribe($event, $handler = null){

        // prevent unsubscribing for non-existing action
        $this->actionExists($event);

        if($handler===null || empty($this->events)){
            $this->events[$event] = array();
        }else{
            foreach($this->events as &$e){
                if($e==$handler){
                    unset($e);
                    break;
                }
            }
        }

        return true;
    }

    /**
     * subscribe for an action
     * @param string $event
     * @param Callable $handler
     * @return int current number of handlers
     * @throws Exceptions\HandlerException
     */
    public function subscribe($event, $handler){

        $this->actionExists($event);

        if(!is_callable($handler)){
            throw new HandlerException('', HandlerException::INCORRECT_HANDLER_SPECIFIED);
        }

        if(!isset($this->events[$event])){
            $this->events[$event] = array();
        }

        $this->events[$event][] = $handler;

        return count($this->events[$event]);
    }

} 