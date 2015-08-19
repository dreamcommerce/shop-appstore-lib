<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Exception;

/**
 * Resource GeolocationRegion
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/geolocation-regions
 * @since shop 5.7.0
 */
class GeolocationRegion extends Resource
{
    protected $name = 'geolocation-regions';

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