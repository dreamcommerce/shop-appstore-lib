<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource Status
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/statuses
 */
class Status extends Resource
{
    /**
     * status: new
     */
    const TYPE_NEW = 1;
    /**
     * status: opened
     */
    const TYPE_OPENED = 2;
    /**
     * status: closed
     */
    const TYPE_CLOSED = 3;
    /**
     * status: not completed
     */
    const TYPE_UNREALIZED = 4;

    protected $name = 'statuses';
}