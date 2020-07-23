<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource Progress
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/progresses
 */
class Progress extends Resource
{
    const STATUS_PENDING = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_FINISHED = 2;
    const STATUS_CANCELLED = 3;
    const STATUS_FAILED = 4;
    const STATUS_FINISHED_CLOSED = 5;
    const STATUS_CANCELLED_CLOSED = 6;
    const STATUS_FAILED_CLOSED = 7;

    protected $name = 'progresses';
}