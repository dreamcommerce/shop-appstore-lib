<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource AdditionalField
 *
 * @package DreamCommerce\Resource
 * @since soon
 */
class AdditionalField extends Resource
{
    const FIELD_TYPE_TEXT = 1;
    const FIELD_TYPE_CHECKBOX = 2;
    const FIELD_TYPE_SELECT = 3;
    const FIELD_TYPE_FILE = 4;
    const FIELD_TYPE_HIDDEN = 5;

    const LOCATE_USER = 1;
    const LOCATE_USER_ACCOUNT = 2;
    const LOCATE_USER_REGISTRATION = 4;

    const LOCATE_ORDER = 8;
    const LOCATE_ORDER_WITH_REGISTRATION = 16;
    const LOCATE_ORDER_WITHOUT_REGISTRATION = 32;
    const LOCATE_ORDER_LOGGED_ON_USER = 64;

    const LOCATE_CONTACT_FORM = 128;

    protected $name = 'additional-field';
}