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

namespace DreamCommerce\Component\ShopAppstore\Billing;

use DreamCommerce\Component\ShopAppstore\Billing\Payload\BillingInstall;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\BillingSubscription;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Install;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Uninstall;
use DreamCommerce\Component\ShopAppstore\Billing\Payload\Upgrade;
use DreamCommerce\Component\ShopAppstore\Exception\Billing\UnableDispatchException;
use Psr\Http\Message\ServerRequestInterface;

interface DispatcherInterface
{
    public const ACTION_BILLING_INSTALL = 'billing_install';
    public const ACTION_BILLING_SUBSCRIPTION = 'billing_subscription';
    public const ACTION_INSTALL = 'install';
    public const ACTION_UPGRADE = 'upgrade';
    public const ACTION_UNINSTALL = 'uninstall';

    public const ACTION_PAYLOAD_MAP = [
        self::ACTION_BILLING_INSTALL => BillingInstall::class,
        self::ACTION_BILLING_SUBSCRIPTION => BillingSubscription::class,
        self::ACTION_INSTALL => Install::class,
        self::ACTION_UPGRADE => Upgrade::class,
        self::ACTION_UNINSTALL => Uninstall::class,
    ];

    /**
     * @param ServerRequestInterface $serverRequest
     *
     * @throws UnableDispatchException
     */
    public function dispatch(ServerRequestInterface $serverRequest): void;
}
