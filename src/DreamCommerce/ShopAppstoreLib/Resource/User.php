<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource User
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/users
 */
class User extends Resource
{
    /**
     * user created via shop
     */
    const ORIGIN_SHOP = 0;
    /**
     * user created via Facebook
     */
    const ORIGIN_FACEBOOK = 1;
    /**
     * user created via mobile
     */
    const ORIGIN_MOBILE = 2;
    /**
     * user created via Allegro
     */
    const ORIGIN_ALLEGRO = 3;

    /**
     * text field
     */
    const FIELD_TYPE_TEXT = 1;
    /**
     * checkbox
     */
    const FIELD_TYPE_CHECKBOX = 2;
    /**
     * select (drop down)
     */
    const FIELD_TYPE_SELECT = 3;

    /**
     * show field for user
     */
    const FIELD_SHOW_USER = 1;
    /**
     * show field for client
     */
    const FIELD_SHOW_CLIENT = 2;
    /**
     * show field during registration
     */
    const FIELD_SHOW_REGISTRATION = 4;

    protected $name = 'users';
}