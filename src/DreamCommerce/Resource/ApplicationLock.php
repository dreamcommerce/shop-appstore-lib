<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource ApplicationLock
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/application-lock
 */
class ApplicationLock extends Resource
{
    protected $isSingleOnly = true;
    protected $name = 'application-lock';
}