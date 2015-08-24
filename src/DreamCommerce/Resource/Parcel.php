<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource Parcel
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/parcels
 */
class Parcel extends Resource
{
    const ADDRESS_TYPE_BILLING = 1;
    const ADDRESS_TYPE_DELIVERY = 2;

    protected $name = 'parcels';
}