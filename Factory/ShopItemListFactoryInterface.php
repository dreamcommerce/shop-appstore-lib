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

namespace DreamCommerce\Component\ShopAppstore\Factory;

use DreamCommerce\Component\ShopAppstore\Api\ItemResourceInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

interface ShopItemListFactoryInterface extends FactoryInterface
{
    /**
     * @param ItemResourceInterface $resource
     * @param ShopInterface $shop
     * @return ShopItemListInterface
     */
    public function createByApiResource(ItemResourceInterface $resource, ShopInterface $shop): ShopItemListInterface;
}