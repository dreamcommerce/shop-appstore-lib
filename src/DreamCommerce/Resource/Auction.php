<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource Auction
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/auctions
 */
class Auction extends Resource
{
    protected $name = 'auctions';

    /**
     * @since soon
     * {@inheritdoc}
     */
    public function post($data)
    {
        return parent::post($data);
    }

    /**
     * @since soon
     * {@inheritdoc}
     */
    public function put($id = null, $data = array())
    {
        return parent::put($id, $data);
    }

    /**
     * @since soon
     * {@inheritdoc}
     */
    public function delete($id = null)
    {
        return parent::delete($id);
    }
}