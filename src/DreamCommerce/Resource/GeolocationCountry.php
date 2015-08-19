<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Exception;
use DreamCommerce\Resource;

/**
 * Resource GeolocationCountry
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/geolocation-countries
 * @since shop 5.7.0
 */
class GeolocationCountry extends Resource
{
    protected $name = 'geolocation-countries';

    /**
     * {@inheritdoc}
     */
    public function post($data)
    {
        throw new Exception('Specified method is not supported');
    }

    /**
     * {@inheritdoc}
     */
    public function put($id = null, $data = array())
    {
        throw new Exception('Specified method is not supported');
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id = null)
    {
        throw new Exception('Specified method is not supported');
    }
}