<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource ProductStock
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/product-stocks
 */
class ProductStock extends Resource
{
    const PRICE_TYPE_KEEP = 0;
    const PRICE_TYPE_NEW = 1;
    const PRICE_TYPE_INCREASE = 2;
    const PRICE_TYPE_DECREASE = 3;

    const WEIGHT_TYPE_KEEP = 0;
    const WEIGHT_TYPE_NEW = 1;
    const WEIGHT_TYPE_INCREASE = 2;
    const WEIGHT_TYPE_DECREASE = 3;

    protected $name = 'product-stocks';
}