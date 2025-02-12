<?php

/*
 * This file is part of the DreamCommerce Shop AppStore package.
 *
 * (c) DreamCommerce
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Api\Resource;

class WebhookResource extends ItemResource implements ObjectAwareResourceInterface
{
    /**
     * webhook data encoded using JSON
     */
    public const FORMAT_JSON = 0;
    /**
     * webhook data encoded using XML
     */
    public const FORMAT_XML = 1;

    /**
     * webhook bound to order create event
     */
    public const EVENT_ORDER_CREATE = 'order.create';

    /**
     * webhook bound to order edit event
     */
    public const EVENT_ORDER_EDIT = 'order.edit';

    /**
     * webhook bound to order is paid event
     */
    public const EVENT_ORDER_PAID = 'order.paid';

    /**
     * webhook bound to order status change
     */
    public const EVENT_ORDER_STATUS = 'order.status';

    /**
     * webhook bound to order delete
     */
    public const EVENT_ORDER_DELETE = 'order.delete';

    /**
     * webhook bound to order placed
     */
    public const EVENT_ORDER_PLACED = 'order.placed';

    /**
     * webhook bound to order refund
     */
    public const EVENT_ORDER_REFUND = 'order.refund';

    /**
     * webhook bound to client create event
     */
    public const EVENT_CLIENT_CREATE = 'client.create';

    /**
     * webhook bound to client edit event
     */
    public const EVENT_CLIENT_EDIT = 'client.edit';

    /**
     * webhook bound to client delete event
     */
    public const EVENT_CLIENT_DELETE = 'client.delete';

    /**
     * webhook bound to product create event
     */
    public const EVENT_PRODUCT_CREATE = 'product.create';

    /**
     * webhook bound to product edit event
     */
    public const EVENT_PRODUCT_EDIT = 'product.edit';

    /**
     * webhook bound to product delete event
     */
    public const EVENT_PRODUCT_DELETE = 'product.delete';

    /**
     * webhook bound to parcel create event
     */
    public const EVENT_PARCEL_CREATE = 'parcel.create';

    /**
     * webhook bound to parcel dispatch event
     */
    public const EVENT_PARCEL_DISPATCH = 'parcel.dispatch';

    /**
     * webhook bound to parcel delete event
     */
    public const EVENT_PARCEL_DELETE = 'parcel.delete';

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'webhooks';
    }

    /**
     * {@inheritdoc}
     */
    public function getExternalIdName(): string
    {
        return 'webhook_id';
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectName(): string
    {
        return 'webhook';
    }
}
