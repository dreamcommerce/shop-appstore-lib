<?php
namespace DreamCommerce\ShopAppstoreLib;

use DreamCommerce\ShopAppstoreLib\Client\Exception\Exception as ClientException;
use DreamCommerce\ShopAppstoreLib\Exception\HandlerException;
use Psr\Log\LoggerInterface;

/**
 * server response handler
 * @package DreamCommerce
 */
class Handler implements HandlerInterface
{
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
        self::EVENT_INSTALL,
        self::EVENT_UNINSTALL,
        self::EVENT_BILLING_INSTALL,
        self::EVENT_BILLING_SUBSCRIPTION,
        self::EVENT_UPGRADE
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
     * @var ClientInterface
     */
    protected $client = null;

    /**
     * application entrypoint
     * @var null|string
     */
    protected $entrypoint = null;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param string $entrypoint
     * @param string $clientId
     * @param string $secret
     * @param string $appStoreSecret
     */
    public function __construct($entrypoint, $clientId, $secret, $appStoreSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $secret;
        $this->entrypoint = $entrypoint;
        $this->appStoreSecret = $appStoreSecret;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch($requestBody = null)
    {
        if($requestBody===null){
            $requestBody = $_POST;
        }

        if(empty($requestBody)){
            throw new HandlerException('Payload empty', HandlerException::PAYLOAD_EMPTY);
        }

        // no action specified?
        if(empty($requestBody['action'])){
            throw new HandlerException('Action not exists', HandlerException::ACTION_NOT_EXISTS);
        }

        // validate if specified action exists
        $this->actionExists($requestBody['action']);

        // calculate hash payload
        $this->verifyPayload($requestBody);

        // fire handlers for specified actions
        $this->fire($requestBody['action'], $requestBody);

    }

    /**
     * {@inheritdoc}
     */
    public function verifyPayload($payload)
    {
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

        if($computedHash != $providedHash) {
            throw new HandlerException('Hash verification failed', HandlerException::HASH_FAILED);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function actionExists($action)
    {
        if(!in_array($action, $this->eventsMap)){
            throw new HandlerException('Action not exists', HandlerException::ACTION_NOT_EXISTS);
        }

        return true;
    }

    /**
     * fires handlers for a specific action
     * @param $action
     * @param $params
     * @throws HandlerException
     */
    protected function fire($action, $params)
    {
        if(!isset($this->events[$action])){
            throw new HandlerException('Action handler not exists', HandlerException::ACTION_HANDLER_NOT_EXISTS);
        }

        // prepare params array for handler
        // we provide a client library as a param for further requests
        $callbackParams = $params;
        $callbackParams['client'] = $this->getClient();
        $callbackParams = new \ArrayObject($callbackParams, \ArrayObject::STD_PROP_LIST);

        // fire handlers for every event
        foreach($this->events[$action] as $e){
            $result = call_user_func($e, $callbackParams);
            if(!$result){
                break;
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function unsubscribe($event, $handler = null)
    {
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
     * {@inheritdoc}
     */
    public function subscribe($event, $handler)
    {
        $this->actionExists($event);

        if(!is_callable($handler)){
            throw new HandlerException('Incorrect handler specified', HandlerException::INCORRECT_HANDLER_SPECIFIED);
        }

        if(!isset($this->events[$event])){
            $this->events[$event] = array();
        }

        $this->events[$event][] = $handler;

        return count($this->events[$event]);
    }

    /**
     * {@inheritdoc}
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getClient()
    {
        if($this->client === null) {
            try {
                $this->client = Client::factory(
                    Client::ADAPTER_OAUTH,
                    array(
                        'entrypoint' => $this->entrypoint,
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret
                    )
                );
            } catch (ClientException $ex) {
                throw new HandlerException('Client initialization failed', HandlerException::CLIENT_INITIALIZATION_FAILED, $ex);
            }
        }

        return $this->client;
    }

    /**
     * {@inheritdoc}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogger()
    {
        if($this->logger === null) {
            $this->logger = new Logger();
        }

        return $this->logger;
    }
} 