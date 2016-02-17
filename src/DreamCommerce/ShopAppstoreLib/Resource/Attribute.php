<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource Attribute
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/attributes
 */
class Attribute extends Resource
{

    /**
     * field type text
     */
    const TYPE_TEXT = 0;
    /**
     * field type checkbox
     */
    const TYPE_CHECKBOX = 1;
    /**
     * field type select
     */
    const TYPE_SELECT = 2;

    protected $name = 'attributes';
}