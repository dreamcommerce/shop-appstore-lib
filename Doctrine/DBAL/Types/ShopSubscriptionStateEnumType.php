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

namespace DreamCommerce\Component\ShopAppstore\Doctrine\DBAL\Types;

use DreamCommerce\Component\Common\Doctrine\DBAL\Types\EnumType;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;

final class ShopSubscriptionStateEnumType extends EnumType
{
    const TYPE_NAME = 'dc_appstore_shop_subscription_state_enum';

    /**
     * @var string
     */
    protected $name = self::TYPE_NAME;

    /**
     * @var array
     */
    protected $values = [
        OAuthShopInterface::STATE_SUBSCRIPTION_EXPIRED,
        OAuthShopInterface::STATE_SUBSCRIPTION_PAID,
        OAuthShopInterface::STATE_SUBSCRIPTION_UNPAID,
    ];
}
