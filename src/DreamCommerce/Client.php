<?php

namespace DreamCommerce;

use DreamCommerce\Exception\ClientException;
use Psr\Log\LoggerInterface;

/**
 * DreamCommerce requesting library
 *
 * @package DreamCommerce
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
class Client
{
    const ADAPTER_OAUTH = 'OAuth';
    const ADAPTER_BASIC_AUTH = 'BasicAuth';

    /**
     * @var \DreamCommerce\Client\OAuth
     */
    protected $adapter = null;

    public static function factory($adapter, $options = array())
    {
        if (!is_string($adapter) || empty($adapter)) {
            throw new ClientException('Adapter name must be specified in a string');
        }

        if (!is_array($options)) {
            throw new ClientException('Adapter parameters must be in an array');
        }

        $adapterNamespace = '\\DreamCommerce\\Client';
        if (isset($config['adapterNamespace'])) {
            if ($config['adapterNamespace'] != '') {
                $adapterNamespace = $config['adapterNamespace'];
            }
            unset($config['adapterNamespace']);
        }

        $adapterName = $adapterNamespace . '\\';
        $adapterName .= str_replace(' ', '\\', ucwords(str_replace('\\', ' ', $adapter)));

        if (!class_exists($adapterName)) {
            throw new ClientException('Cannot load class "' . $adapterName . '"');
        }

        $clientAdapter = new $adapterName($options);

        if(! $clientAdapter instanceof ClientInterface) {
            throw new ClientException('Adapter class "' . $adapterName . '" does not extend \\DreamCommerce\\ClientInterface');
        }

        return $clientAdapter;
    }

    /*
     * ----------------------------------------------------------------------------
     * BACKWARD COMPATIBILITY
     * ----------------------------------------------------------------------------
     */

    /**
     * @param string $entrypoint shop url
     * @param string $clientId
     * @param string $clientSecret
     * @throws \DreamCommerce\Exception\ClientException
     * @deprecated
     */
    public function __construct($entrypoint, $clientId, $clientSecret)
    {
        $adapter = self::factory(self::ADAPTER_OAUTH, array(
            'entrypoint' => $entrypoint,
            'client_id' => $clientId,
            'client_secret' => $clientSecret
        ));

        $this->adapter = $adapter;
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function request(Resource $res, $method, $objectPath = null, $data = array(), $query = array())
    {
        return $this->adapter->request($res, $method, $objectPath, $data, $query);
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function setHttpClient(HttpInterface $httpClient)
    {
        return $this->adapter->setHttpClient($httpClient);
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function getHttpClient()
    {
        return $this->adapter->getHttpClient();
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function getLocale()
    {
        return $this->adapter->getLocale();
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function setLocale($locale)
    {
        return $this->adapter->setLocale($locale);
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function setLogger(LoggerInterface $logger)
    {
        return $this->adapter->setLogger($logger);
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function getLogger()
    {
        return $this->adapter->getLogger();
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function getToken($authCode = null)
    {
        if($authCode !== null) {
            $this->adapter->setAuthCode($authCode);
        }
        return $this->adapter->authenticate();
    }

    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function refreshToken($refreshToken = null)
    {
        if($refreshToken !== null) {
            $this->adapter->setRefreshToken($refreshToken);
        }
        return $this->adapter->refreshTokens();
    }

    /**
     * Automagic instantiator, alternative:
     * $resource = new \DreamCommerce\Resource(Client $client, 'name')
     *
     * @return Resource
     * @param $resource
     * @deprecated
     */
    public function __get($resource){
        return Resource::factory($this->adapter, $resource);
    }
}