<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Exception;

/**
 * Resource GeolocationSubregion
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/geolocation-subregions
 * @since shop 5.7.7
 */
class GeolocationSubregion extends Resource
{
    protected $name = 'geolocation-subregions';

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