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

namespace DreamCommerce\Component\ShopAppstore;

final class ShopSubscriptionTransitions
{
    public const GRAPH = 'dream_commerce_appstore_shop_subscription';

    public const TRANSITION_PAY = 'pay';
    public const TRANSITION_EXPIRE = 'expire';
    public const TRANSITION_RENEW = 'renew';
    public const TRANSITION_EXTEND = 'extend';

    private function __construct()
    {
    }
}
