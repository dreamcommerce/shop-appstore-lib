<?php

namespace DreamCommerce\Client;

use DreamCommerce\ClientInterface;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\HttpException;
use DreamCommerce\Http;
use DreamCommerce\HttpInterface;
use DreamCommerce\Logger;
use DreamCommerce\Resource;
use Psr\Log\LoggerInterface;

/**
 * Class AbstractClient
 * @package DreamCommerce\Client
 *
 * @property-read Resource\Aboutpage $aboutPage
 * @property-read Resource\ApplicationLock $applicationLock
 * @property-read Resource\ApplicationVersion $applicationVersion
 * @property-read Resource\Attribute $attribute
 * @property-read Resource\AttributeGroup $attributeGroup
 * @property-read Resource\Auction $auction
 * @property-read Resource\AuctionHouse $auctionHouse
 * @property-read Resource\AuctionOrder $auctionOrder
 * @property-read Resource\Availability $availability
 * @property-read Resource\CategoriesTree $categoriesTree
 * @property-read Resource\Category $category
 * @property-read Resource\Currency $currency
 * @property-read Resource\DashboardActivity $dashboardActivity
 * @property-read Resource\DashboardStat $dashboardStat
 * @property-read Resource\Delivery $delivery
 * @property-read Resource\Gauge $gauge
 * @property-read Resource\GeolocationCountry $geolocationCountry
 * @property-read Resource\GeolocationRegion $geolocationRegion
 * @property-read Resource\Language $language
 * @property-read Resource\Metafield $metafield
 * @property-read Resource\MetafieldValue $metafieldValue
 * @property-read Resource\ObjectMtime $objectMtime
 * @property-read Resource\Option $option
 * @property-read Resource\OptionGroup $optionGroup
 * @property-read Resource\OptionValue $optionValue
 * @property-read Resource\Order $order
 * @property-read Resource\OrderProduct $orderProduct
 * @property-read Resource\Parcel $parcel
 * @property-read Resource\Payment $payment
 * @property-read Resource\Producer $producer
 * @property-read Resource\Product $product
 * @property-read Resource\ProductFile $productFile
 * @property-read Resource\ProductImage $productImage
 * @property-read Resource\ProductStock $productStock
 * @property-read Resource\Shipping $shipping
 * @property-read Resource\Status $status
 * @property-read Resource\Subscriber $subscriber
 * @property-read Resource\SubscriberGroup $subscriberGroup
 * @property-read Resource\Tax $tax
 * @property-read Resource\Unit $unit
 * @property-read Resource\User $user
 * @property-read Resource\UserAddress $userAddress
 * @property-read Resource\UserGroup $userGroup
 * @property-read Resource\Webhook $webhook
 * @property-read Resource\Zone $zone
 */
abstract class Bearer implements ClientInterface
{
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
     * @param array $options
     * @throws \DreamCommerce\Exception\ClientException
     */
    public function __construct($options = array())
    {
        if(!is_array($options)) {
            throw new ClientException('Adapter parameters must be in an array', ClientException::PARAMETER_NOT_SPECIFIED);
        }

        if(!isset($options['entrypoint'])) {
            throw new ClientException('Parameter "entrypoint" is required', ClientException::PARAMETER_NOT_SPECIFIED);
        }

        $entrypoint = $options['entrypoint'];

        if(!filter_var($entrypoint, FILTER_VALIDATE_URL)){
            throw new ClientException('Invalid entrypoint URL', ClientException::ENTRYPOINT_URL_INVALID);
        }

        // adjust base URL
        if($entrypoint[strlen($entrypoint)-1]=='/'){
            $entrypoint = substr($entrypoint, 0, -1);
        }

        // adjust webapi query
        if(strpos($entrypoint, '/webapi/rest')===false){
            $entrypoint .= '/webapi/rest';
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
            throw new ClientException('Method not supported', ClientException::METHOD_NOT_SUPPORTED);
        }

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

        try {
            // dispatch correct method
            if(in_array($method, array('get', 'delete'))){
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
                        return;
                    }
                }
            }

            throw new ClientException('HTTP error: '.$ex->getMessage(), ClientException::API_ERROR, $ex);
        }
    }

    /**
     * fired if token is invalid
     * @param Callable|null $callback
     * @return $this
     */
    public function setOnTokenInvalidHandler($callback = null)
    {
        $this->onTokenInvalidHandler = $callback;
        return $this;
    }

    /**
     * @return string
     * @throws \DreamCommerce\Exception\ClientException
     */
    public function getAccessToken()
    {
        if($this->accessToken === null) {
            throw new ClientException('Parameter "access_token" is required', ClientException::PARAMETER_NOT_SPECIFIED);
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
        }

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
     * Automagic instantiator, alternative:
     * $resource = new \DreamCommerce\Resource(Client $client, 'name')
     *
     * @return Resource
     * @param $resource
     */
    public function __get($resource)
    {
        return Resource::factory($this, $resource);
    }
}