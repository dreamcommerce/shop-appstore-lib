<?php

namespace DreamCommerce\ShopAppstoreLib\Client;

use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\ShopAppstoreLib\Client\Exception\Exception;
use DreamCommerce\ShopAppstoreLib\Exception\HttpException;
use DreamCommerce\ShopAppstoreLib\Http;
use DreamCommerce\ShopAppstoreLib\HttpInterface;
use DreamCommerce\ShopAppstoreLib\Logger;
use DreamCommerce\ShopAppstoreLib\Resource;
use Psr\Log\LoggerInterface;

/**
 * Class AbstractClient
 * @package DreamCommerce\ShopAppstoreLib\Client
 */
abstract class Bearer implements ClientInterface
{
    const HTTP_ERROR_INVALID_REQUEST = "invalid_request";

    const HTTP_ERROR_UNAUTHORIZED_CLIENT = "unauthorized_client";

    const HTTP_ERROR_ACCESS_DENIED = "access_denied";

    const HTTP_ERROR_UNSUPPORTED_RESPONSE_TYPE = "unsupported_response_type";

    const HTTP_ERROR_UNSUPPORTED_GRANT_TYPE = "unsupported_grant_type";

    const HTTP_ERROR_INVALID_SCOPE = "invalid_scope";

    const HTTP_ERROR_INVALID_GRANT = "invalid_grant";

    const HTTP_ERROR_INSUFFICIENT_SCOPE = "insufficient_scope";

    const HTTP_ERROR_REDIRECT_URI_MISMATCH = "redirect_uri_mismatch";

    const HTTP_ERROR_SERVER_ERROR = "server_error";

    const HTTP_ERROR_TEMPORARILY_UNAVAILABLE = "temporarily_unavailable";

    /**
     * API entrypoint
     * @var null|string
     */
    protected $entrypoint = null;

    /**
     * Access token
     * @var string
     */
    protected $accessToken = null;

    /**
     * Expires in
     * @var integer
     */
    protected $expiresIn = 0;

    /**
     * @var \Callable
     */
    protected $onTokenInvalidHandler;

    /**
     * HTTP Client handle
     * @var HttpInterface|null
     */
    protected $httpClient = null;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var string
     */
    protected $locale = 'en_US';
    /**
     * skip SSL verify name
     * @var bool
     */
    protected $skipSsl;

    /**
     * user agent used to include with every request
     * @var string
     */
    protected $userAgent = null;

    /**
     * @param array $options
     * @throws \DreamCommerce\ShopAppstoreLib\Exception\Exception
     */
    public function __construct($options = array())
    {
        if(!is_array($options)) {
            throw new Exception('Adapter parameters must be in an array', Exception::PARAMETER_NOT_SPECIFIED);
        }

        if(!isset($options['entrypoint'])) {
            throw new Exception('Parameter "entrypoint" is required', Exception::PARAMETER_NOT_SPECIFIED);
        }

        if(isset($options['skip_ssl'])){
            $this->skipSsl = true;
        }

        $entrypoint = $options['entrypoint'];

        if(!filter_var($entrypoint, FILTER_VALIDATE_URL)){
            throw new Exception('Invalid entrypoint URL', Exception::ENTRYPOINT_URL_INVALID);
        }

        // adjust base URL
        if($entrypoint[strlen($entrypoint)-1]=='/'){
            $entrypoint = substr($entrypoint, 0, -1);
        }

        // adjust webapi query
        if(strpos($entrypoint, '/webapi/rest')===false){
            $entrypoint .= '/webapi/rest';
        }

        if(!empty($options['userAgent'])) {
            $this->userAgent = $options['userAgent'];
        }else{
            if (empty($this->userAgent)) {
                if (is_callable(array($this, 'getClientId'))) {
                    $this->userAgent = $this->getClientId();
                } else if (is_callable(array($this, 'getUsername'))) {
                    $this->userAgent = $this->getUsername();
                }
            }
        }

        $this->entrypoint = $entrypoint;
    }

    /**
     * {@inheritdoc}
     */
    public function request(Resource $res, $method, $objectPath = null, $data = array(), $query = array())
    {
        $this->authenticate();

        $client = $this->getHttpClient();

        if(!method_exists($client, $method)) {
            throw new Exception('Method not supported', Exception::METHOD_NOT_SUPPORTED);
        }

        $client->setSkipSsl($this->skipSsl);

        $url = $this->entrypoint.'/'.$res->getName();
        if($objectPath){
            if(is_array($objectPath)){
                $objectPath = join('/', $objectPath);
            }
            $url .= '/'.$objectPath;
        }

        $headers = array(
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'Content-Type' => 'application/json',
            'Accept-Language' => $this->getLocale() . ';q=0.8'
        );

        $this->injectUserAgent($headers);

        try {
            // dispatch correct method
            if(in_array($method, array('get', 'delete', 'head'))){
                return call_user_func(array(
                    $client, $method
                ), $url, $query, $headers);
            } else {
                return call_user_func(array(
                    $client, $method
                ), $url, $data, $query, $headers);
            }

        } catch(HttpException $ex) {

            // fire a handler for token reneval
            $previous = $ex->getPrevious();
            if($previous instanceof HttpException){
                $response = $previous->getResponse();
                $handler = $this->onTokenInvalidHandler;
                if($response['error']=='unauthorized_client' && $handler){
                    $exceptionHandled = $handler($this, $ex);
                    if($exceptionHandled){
                        return array();
                    }
                }
            }

            throw new Exception('HTTP error: '.$ex->getMessage(), Exception::API_ERROR, $ex);
        }
    }

    /**
     * @inheritdoc
     */
    public function setOnTokenInvalidHandler($callback = null)
    {
        $this->onTokenInvalidHandler = $callback;
        return $this;
    }

    /**
     * @return string
     * @throws \DreamCommerce\ShopAppstoreLib\Exception\Exception
     */
    public function getAccessToken()
    {
        if($this->accessToken === null) {
            throw new Exception('Parameter "access_token" is required', Exception::PARAMETER_NOT_SPECIFIED);
        }

        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     * @return $this
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpClient(HttpInterface $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpClient()
    {
        if($this->httpClient === null) {
            $this->httpClient = Http::instance();
            if($this->logger){
                $this->httpClient->setLogger($this->logger);
            }
        }

        $this->httpClient->setSkipSsl($this->skipSsl);

        return $this->httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
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

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * inject user agent to the headers array
     * @param array $headers
     * @return array
     */
    protected function injectUserAgent($headers){
        if(!empty($this->userAgent)){
            $headers['User-Agent'] = $this->userAgent;
        }

        return $headers;
    }
}