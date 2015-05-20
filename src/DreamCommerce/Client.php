<?php

namespace DreamCommerce;

use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\HttpException;
use Psr\Log\LoggerInterface;

/**
 * DreamCommerce requesting library
 *
 * @package DreamCommerce
 * @property-read Resource\Aboutpage $aboutPage
 * @property-read Resource\ApplicationLock $applicationLock
 * @property-read Resource\Attribute $attribute
 * @property-read Resource\AttributeGroup $attributeGroup
 * @property-read Resource\Auction $auction
 * @property-read Resource\AuctionHouse $auctionHouse
 * @property-read Resource\Availability $availability
 * @property-read Resource\CategoriesTree $categoriesTree
 * @property-read Resource\Category $category
 * @property-read Resource\Currency $currency
 * @property-read Resource\DashboardActivity $dashboardActivity
 * @property-read Resource\DashboardStat $dashboardStat
 * @property-read Resource\Delivery $delivery
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
 */
class Client implements ClientInterface
{
    /**
     * API entrypoint
     * @var null|string
     */
    protected $entrypoint = null;

    /**
     * OAuth ID
     * @var null|string
     */
    protected $clientId = null;
    /**
     * OAuth secret
     * @var null|string
     */
    protected $clientSecret = null;

    /**
     * HTTP Client handle
     * @var Http|null
     */
    protected $httpClient = null;

    /**
     * access token
     * @var string
     */
    protected $accessToken = null;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param string $entrypoint shop url
     * @param string $clientId
     * @param string $clientSecret
     * @throws Exception\ClientException
     */
    public function __construct($entrypoint, $clientId, $clientSecret)
    {
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
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * @inheritdoc
     */
    public function getToken($authCode)
    {
        $res = $this->getHttpClient()->post($this->entrypoint.'/oauth/token', array(
            'code'=>$authCode
        ), array(
            'grant_type'=>'authorization_code'
        ), array(
            'Authorization'=>'Basic '.base64_encode($this->clientId.':'.$this->clientSecret)
        ));

        if(!$res || isset($res['data']['error'])){
            throw new ClientException($res['data']['error'], ClientException::API_ERROR);
        }

        // automatically set token to the freshly requested
        $this->setAccessToken($res['data']['access_token']);

        return $res['data'];
    }

    /**
     * @inheritdoc
     */
    public function refreshToken($refreshToken)
    {
        $res = $this->getHttpClient()->post($this->entrypoint.'/oauth/token', array(
            'client_id'=>$this->clientId,
            'client_secret'=>$this->clientSecret,
            'refresh_token'=>$refreshToken
        ), array(
            'grant_type'=>'refresh_token'
        ));

        if(!$res || !empty($res['data']['error'])){
            throw new ClientException($res['error'], ClientException::API_ERROR);
        }

        $this->setAccessToken($res['data']['access_token']);

        return $res['data'];
    }

    /**
     * Sets an access token for further requests
     * @param $token
     */
    public function setAccessToken($token)
    {
        $this->accessToken = $token;
    }

    /**
     * @inheritdoc
     */
    public function request(Resource $res, $method, $objectPath = null, $data = array(), $query = array())
    {
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

        // setup OAuth token and we request JSON
        $headers = array(
            'Authorization'=>'Bearer '.$this->accessToken,
            'Content-Type'=>'application/json'
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
            throw new ClientException('HTTP error: '.$ex->getMessage(), ClientException::API_ERROR, $ex);
        }
    }

    /**
     * Automagic instantiator, alternative:
     * $resource = new \DreamCommerce\Resource(Client $client, 'name')
     *
     * @return Resource
     * @param $resource
     */
    public function __get($resource){
        return Resource::factory($this, $resource);
    }

    /**
     * @inheritdoc
     */
    public function setHttpClient(HttpInterface $httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getHttpClient()
    {
        if($this->httpClient === null) {
            $this->httpClient = Http::instance();
        }

        return $this->httpClient;
    }

    /**
     * @inheritdoc
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLogger()
    {
        if($this->logger === null) {
            $this->logger = new Logger();
        }

        return $this->logger;
    }
}
