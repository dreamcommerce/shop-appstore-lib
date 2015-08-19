<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource Shipping
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/shippings
 */
class Shipping extends Resource
{
    protected $name = 'shippings';

    /**
     * @since shop 5.7.0
     * {@inheritdoc}
     */
    public function post($data)
    {
        return parent::post($data);
    }

    /**
     * @since shop 5.7.0
     * {@inheritdoc}
     */
    public function put($id = null, $data = array())
    {
        return parent::put($id, $data);
    }

    /**
     * @since shop 5.7.0
     * {@inheritdoc}
     */
    public function delete($id = null)
    {
        return parent::delete($id);
    }
}