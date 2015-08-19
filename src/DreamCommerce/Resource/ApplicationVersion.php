<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource ApplicationVersion
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/application-version
 * @since shop 5.7.0
 */
class ApplicationVersion extends Resource
{
    protected $isSingleOnly = true;
    protected $name = 'application-version';
}