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

namespace DreamCommerce\Component\ShopAppstore\Model;

final class ShopItemList extends AbstractShopItemList implements ShopItemListInterface
{
    use ShopDependTrait;

    /**
     * {@inheritdoc}
     */
    public function addPart(ShopItemPartList $itemPartList): void
    {
        $this->setItems(array_merge($this->items, $itemPartList->items));
    }
}
