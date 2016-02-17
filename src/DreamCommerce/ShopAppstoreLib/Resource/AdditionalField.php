<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource AdditionalField
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
  */
class AdditionalField extends Resource
{
    /**
     * text input
     */
    const FIELD_TYPE_TEXT = 1;
    /**
     * checkbox field
     */
    const FIELD_TYPE_CHECKBOX = 2;
    /**
     * select (drop down)
     */
    const FIELD_TYPE_SELECT = 3;
    /**
     * file input
     */
    const FIELD_TYPE_FILE = 4;
    /**
     * hidden field
     */
    const FIELD_TYPE_HIDDEN = 5;

    /**
     * place field in user context
     */
    const LOCATE_USER = 1;
    /**
     * place field in user account panel
     */
    const LOCATE_USER_ACCOUNT = 2;
    /**
     * place field in user registration
     */
    const LOCATE_USER_REGISTRATION = 4;

    /**
     * place field in order
     */
    const LOCATE_ORDER = 8;
    /**
     * place field when user is being registered upon order
     */
    const LOCATE_ORDER_WITH_REGISTRATION = 16;
    /**
     * place field when user is not being registered upon order
     */
    const LOCATE_ORDER_WITHOUT_REGISTRATION = 32;
    /**
     * place field when user is logged in upon order
     */
    const LOCATE_ORDER_LOGGED_ON_USER = 64;

    /**
     * place field in contact form
     */
    const LOCATE_CONTACT_FORM = 128;

    protected $name = 'additional-fields';
}