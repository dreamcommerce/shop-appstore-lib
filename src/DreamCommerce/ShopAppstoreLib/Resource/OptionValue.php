<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource OptionValue
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/option-values
 */
class OptionValue extends Resource
{
    /**
     * This option type doesn't support values management
     */
    const HTTP_ERROR_OPTION_CHILDREN_NOT_SUPPORTED = 'option_children_not_supported';

    /**
     * option value decreases prices
     */
    const PRICE_TYPE_DECREASE = -1;
    /**
     * option value keeps price unchanged
     */
    const PRICE_TYPE_KEEP = 0;
    /**
     * option value increases price
     */
    const PRICE_TYPE_INCREASE = 1;

    /**
     * price changed by percent
     */
    const PRICE_PERCENT = 0;
    /**
     * price changed by value
     */
    const PRICE_AMOUNT = 1;

    protected $name = 'option-values';
}