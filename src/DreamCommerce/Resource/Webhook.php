<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;

/**
 * Resource Webhook
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/webhooks
 */
class Webhook extends Resource
{
    const FORMAT_JSON = 0;
    const FORMAT_XML = 1;

    const EVENT_ORDER_CREATE = 'order.create';
    const EVENT_ORDER_EDIT = 'order.edit';
    const EVENT_ORDER_PAID = 'order.paid';
    const EVENT_ORDER_STATUS = 'order.status';
    const EVENT_ORDER_DELETE = 'order.delete';
    const EVENT_CLIENT_CREATE = 'client.create';
    const EVENT_CLIENT_EDIT = 'client.edit';
    const EVENT_CLIENT_DELETE = 'client.delete';
    const EVENT_PRODUCT_CREATE = 'product.create';
    const EVENT_PRODUCT_EDIT = 'product.edit';
    const EVENT_PRODUCT_DELETE = 'product.delete';
    const EVENT_PARCEL_CREATE = 'parcel.create';
    const EVENT_PARCEL_DISPATCH = 'parcel.dispatch';
    const EVENT_PARCEL_DELETE = 'parcel.delete';

    protected $name = 'webhooks';
}