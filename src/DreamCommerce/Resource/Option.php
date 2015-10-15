<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource Option
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/options
 */
class Option extends Resource
{
    /**
     * It's not possible to change required flag for option with warehouse support
     */
    const HTTP_ERROR_OPTION_CAN_NOT_MODIFY_REQUIRE = "option_cannot_modify_require";

    /**
     * It's not possible to change type of an existing option
     */
    const HTTP_ERROR_OPTION_CAN_NOT_MODIFY_TYPE = 'option_cannot_modify_type';

    const PRICE_TYPE_DECREASE = -1;
    const PRICE_TYPE_KEEP = 0;
    const PRICE_TYPE_INCREASE = 1;

    const PRICE_PERCENT = 0;
    const PRICE_AMOUNT = 1;

    protected $name = 'options';
}