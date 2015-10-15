<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource Zone
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/zones
 * @since shop 5.7.0
 */
class Zone extends Resource
{
    const ZONE_MODE_COUNTRIES = 1;
    const ZONE_MODE_REGIONS = 2;
    const ZONE_MODE_CODES = 3;

    protected $name = 'zones';
}