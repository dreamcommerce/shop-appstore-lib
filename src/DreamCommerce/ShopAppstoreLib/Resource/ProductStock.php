<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource ProductStock
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/product-stocks
 */
class ProductStock extends Resource
{
    /**
     * keep base price
     */
    const PRICE_TYPE_KEEP = 0;
    /**
     * specify price for stock
     */
    const PRICE_TYPE_NEW = 1;
    /**
     * increase base price
     */
    const PRICE_TYPE_INCREASE = 2;
    /**
     * dreacrease base price
     */
    const PRICE_TYPE_DECREASE = 3;

    /**
     * keep base weight
     */
    const WEIGHT_TYPE_KEEP = 0;
    /**
     * specify weight for stock
     */
    const WEIGHT_TYPE_NEW = 1;
    /**
     * increase base weight
     */
    const WEIGHT_TYPE_INCREASE = 2;
    /**
     * decrease base weight
     */
    const WEIGHT_TYPE_DECREASE = 3;

    protected $name = 'product-stocks';
}