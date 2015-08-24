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

    const FIELD_SHOW_USER = 1;
    const FIELD_SHOW_CLIENT = 2;
    const FIELD_SHOW_REGISTRATION = 4;

    const FIELD_SHOW_ORDER = 8;
    const FIELD_SHOW_REGISTERED = 16;
    const FIELD_SHOW_GUEST = 32;
    const FIELD_SHOW_SIGNED_IN = 64;

    const FIELD_SHOW_CONTACT_FORM = 128;

    protected $name = 'additional-field';
}