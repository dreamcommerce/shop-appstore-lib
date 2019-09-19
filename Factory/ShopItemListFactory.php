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
use DreamCommerce\Component\ShopAppstore\Model\ShopItemList;
use DreamCommerce\Component\ShopAppstore\Model\ShopItemListInterface;

class ShopItemListFactory implements ShopItemListFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        return new ShopItemList();
    }

    /**
     * {@inheritdoc}
     */
    public function createByApiResource(ItemResourceInterface $resource, ShopInterface $shop): ShopItemListInterface
    {
        $list = $this->createNew();
        $list->setShop($shop);

        return $list;
    }
}