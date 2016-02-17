<?php

namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;

/**
 * Resource Order
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/orders
 */
class Order extends Resource
{
    /**
     * Combined order has been detected
     */
    const HTTP_ERROR_ORDER_COMBINED = "order_combined";

    /**
     * order comes from shop
     */
    const ORIGIN_SHOP = 0;
    /**
     * order comes from Facebook
     */
    const ORIGIN_FACEBOOK = 1;
    /**
     * order comes from mobile
     */
    const ORIGIN_MOBILE = 2;
    /**
     * order comes from Allegro
     */
    const ORIGIN_ALLEGRO = 3;
    /**
     * order comes from WebAPI
     */
    const ORIGIN_WEBAPI = 4;

    /**
     * order field type is text
     */
    const FIELD_TYPE_TEXT = 1;
    /**
     * order field type is checkbox
     */
    const FIELD_TYPE_CHECKBOX = 2;
    /**
     * order field type is select (drop down)
     */
    const FIELD_TYPE_SELECT = 3;

    /**
     * place field in order
     */
    const FIELD_SHOW_ORDER = 8;
    /**
     * place field if user is being registered
     */
    const FIELD_SHOW_REGISTERED = 16;
    /**
     * place field if user is not registered
     */
    const FIELD_SHOW_GUEST = 32;
    /**
     * place field if use is signed in
     */
    const FIELD_SHOW_SIGNED_IN = 64;

    /**
     * address is for billing purposes
     */
    const ADDRESS_TYPE_BILLING = 1;
    /**
     * address is for delivery purposes
     */
    const ADDRESS_TYPE_DELIVERY = 2;

    protected $name = 'orders';
}