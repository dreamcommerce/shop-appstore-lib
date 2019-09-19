<?php

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Doctrine\DBAL\Types;

use DreamCommerce\Component\Common\Doctrine\DBAL\Types\EnumType;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;

final class ShopBillingStateEnumType extends EnumType
{
    const TYPE_NAME = 'dc_appstore_shop_billing_state_enum';

    /**
     * @var string
     */
    protected $name = self::TYPE_NAME;

    /**
     * @var array
     */
    protected $values = array(
        OAuthShopInterface::STATE_BILLING_UNPAID,
        OAuthShopInterface::STATE_BILLING_PAID,
        OAuthShopInterface::STATE_BILLING_REFUNDED,
        OAuthShopInterface::STATE_BILLING_CANCELLED,
    );
}
