<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource Zone
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/zones
 * @since shop 5.7.0
 */
class Zone extends Resource
{
    /**
     * zone division by countries
     */
    const ZONE_MODE_COUNTRIES = 1;
    /**
     * zone division by regions
     */
    const ZONE_MODE_REGIONS = 2;
    /**
     * zone supports post codes
     */
    const ZONE_MODE_CODES = 3;

    protected $name = 'zones';
}