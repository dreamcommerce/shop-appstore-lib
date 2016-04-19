<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;
use DreamCommerce\ShopAppstoreLib\Exception;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\MethodUnsupportedException;

/**
 * Resource ApplicationVersion
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/application-version
 */
class ApplicationVersion extends Resource
{
    protected $isSingleOnly = true;
    protected $name = 'application-version';

}