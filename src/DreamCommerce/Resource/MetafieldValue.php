<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource MetafieldValue
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/metafield-values
 */
class MetafieldValue extends Resource
{
    protected $name = 'metafield-values';

    protected function isCollection($args)
    {
        return empty($args[0]) || !is_numeric($args[0]);
    }
}