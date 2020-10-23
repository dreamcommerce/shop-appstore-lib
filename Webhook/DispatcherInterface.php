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

namespace DreamCommerce\Component\ShopAppstore\Webhook;

use DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use Psr\Http\Message\ServerRequestInterface;

interface DispatcherInterface
{
    public const ACTION_ORDER_CREATE = 'order.create';
    public const ACTION_ORDER_EDIT = 'order.edit';
    public const ACTION_ORDER_PAID = 'order.paid';
    public const ACTION_ORDER_STATUS = 'order.status';
    public const ACTION_ORDER_DELETE = 'order.delete';

    public const ACTION_CLIENT_CREATE = 'client.create';
    public const ACTION_CLIENT_EDIT = 'client.edit';
    public const ACTION_CLIENT_DELETE = 'client.delete';

    public const ACTION_PRODUCT_CREATE = 'product.create';
    public const ACTION_PRODUCT_EDIT = 'product.edit';
    public const ACTION_PRODUCT_DELETE = 'product.delete';

    public const ACTION_PARCEL_CREATE = 'parcel.create';
    public const ACTION_PARCEL_DISPATCH = 'parcel.dispatch';

    public const ALL_ORDER_ACTIONS = [
        self::ACTION_ORDER_CREATE,
        self::ACTION_ORDER_EDIT,
        self::ACTION_ORDER_PAID,
        self::ACTION_ORDER_STATUS,
        self::ACTION_ORDER_DELETE,
    ];

    public const ALL_CLIENT_ACTIONS = [
        self::ACTION_CLIENT_CREATE,
        self::ACTION_CLIENT_EDIT,
        self::ACTION_CLIENT_DELETE,
    ];

    public const ALL_PRODUCT_ACTIONS = [
        self::ACTION_PRODUCT_CREATE,
        self::ACTION_PRODUCT_EDIT,
        self::ACTION_PRODUCT_DELETE,
    ];

    public const ALL_PARCEL_ACTIONS = [
        self::ACTION_PARCEL_CREATE,
        self::ACTION_PARCEL_DISPATCH,
    ];

    public const ALL_ACTIONS = [
        self::ACTION_ORDER_CREATE,
        self::ACTION_ORDER_EDIT,
        self::ACTION_ORDER_PAID,
        self::ACTION_ORDER_STATUS,
        self::ACTION_ORDER_DELETE,
        self::ACTION_CLIENT_CREATE,
        self::ACTION_CLIENT_EDIT,
        self::ACTION_CLIENT_DELETE,
        self::ACTION_PRODUCT_CREATE,
        self::ACTION_PRODUCT_EDIT,
        self::ACTION_PRODUCT_DELETE,
        self::ACTION_PARCEL_CREATE,
        self::ACTION_PARCEL_DISPATCH,
    ];

    /**
     * @param ServerRequestInterface $serverRequest
     * @param ApplicationInterface|null $application
     *
     * @throws UnableDispatchException
     */
    public function dispatch(ServerRequestInterface $serverRequest, ApplicationInterface $application = null): void;

    /**
     * @param ListenerInterface $listener
     * @param string|array $actions
     */
    public function registerListener(ListenerInterface $listener, $actions): void;
}
