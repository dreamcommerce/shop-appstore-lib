<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Doctrine\DBAL\Types;

use DreamCommerce\Component\Common\Doctrine\DBAL\Types\EnumType;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;

final class ShopSubscriptionStateTinyIntType extends EnumType
{
    const TYPE_NAME = 'dc_appstore_shop_subscription_state_tinyint';

    /**
     * @var string
     */
    protected $name = self::TYPE_NAME;

    /**
     * @var array
     */
    protected $values = array(
        OAuthShopInterface::STATE_SUBSCRIPTION_EXPIRED => 1,
        OAuthShopInterface::STATE_SUBSCRIPTION_PAID => 2,
        OAuthShopInterface::STATE_SUBSCRIPTION_UNPAID => 3,
    );
}
