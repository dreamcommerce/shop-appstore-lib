<?php

namespace DreamCommerce\ShopAppstoreLib;

use DreamCommerce\ShopAppstoreLib\Exception\ClientException;

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
     * @var Client\OAuth
     */
    protected $adapter = null;

    /**
     * @var ClientInterface
     */
    protected static $defaultAdapter = null;

    /**
     * @param string $adapter
     * @param array $options
     * @return ClientInterface
     * @throws ClientException
     */
    public static function factory($adapter, $options = array())
    {
        if (!is_string($adapter) || empty($adapter)) {
            throw new ClientException('Adapter name must be specified in a string');
        }

        if (!is_array($options)) {
            throw new ClientException('Adapter parameters must be in an array');
        }

        $adapterNamespace = '\\DreamCommerce\ShopAppstoreLib\\Client';
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

        if(!($clientAdapter instanceof ClientInterface)) {
            throw new ClientException('Adapter class "' . $adapterName . '" does not implement \\DreamCommerce\ShopAppstoreLib\\ClientInterface');
        }

        if(self::$defaultAdapter === null) {
            self::$defaultAdapter = $clientAdapter;
        }

        return $clientAdapter;
    }

    /**
     * @return null|ClientInterface
     */
    public static function getDefaultAdapter()
    {
        return self::$defaultAdapter;
    }

    /**
     * @param ClientInterface $adapter
     */
    public static function setDefaultAdapter(ClientInterface $adapter)
    {
        self::$defaultAdapter = $adapter;
    }

}