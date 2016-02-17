<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;
use DreamCommerce\ShopAppstoreLib\Exception;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\MethodUnsupportedException;

/**
 * Resource ApplicationLock
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/application-lock
 */
class ApplicationLock extends Resource
{
    protected $isSingleOnly = true;
    protected $name = 'application-lock';

}