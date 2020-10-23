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

use DreamCommerce\Component\Common\Doctrine\DBAL\Types\MapEnumType;
use DreamCommerce\Component\ShopAppstore\Model\OAuthShopInterface;

final class ShopBillingStateTinyIntType extends MapEnumType
{
    const TYPE_NAME = 'dc_appstore_shop_billing_state_tinyint';

    /**
     * @var string
     */
    protected $enumType = self::TYPE_UINT8;

    /**
     * @var string
     */
    protected $name = self::TYPE_NAME;

    /**
     * @var array
     */
    protected $values = [
        OAuthShopInterface::STATE_BILLING_UNPAID => 1,
        OAuthShopInterface::STATE_BILLING_PAID => 2,
        OAuthShopInterface::STATE_BILLING_REFUNDED => 3,
        OAuthShopInterface::STATE_BILLING_CANCELLED => 4,
    ];
}
