<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource OptionValue
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/option-values
 */
class OptionValue extends Resource
{
    const PRICE_TYPE_DECREASE = -1;
    const PRICE_TYPE_KEEP = 0;
    const PRICE_TYPE_INCREASE = 1;

    const PRICE_PERCENT = 0;
    const PRICE_AMOUNT = 1;

    protected $name = 'option-values';
}