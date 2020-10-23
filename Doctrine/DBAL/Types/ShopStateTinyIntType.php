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

final class ShopStateTinyIntType extends MapEnumType
{
    const TYPE_NAME = 'dc_appstore_shop_state_tinyint';

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
        OAuthShopInterface::STATE_NEW => 1,
        OAuthShopInterface::STATE_UNINSTALLED => 2,
        OAuthShopInterface::STATE_PREFETCH_TOKENS => 3,
        OAuthShopInterface::STATE_REJECTED_AUTH_CODE => 4,
        OAuthShopInterface::STATE_INSTALLED => 5,
    ];
}
