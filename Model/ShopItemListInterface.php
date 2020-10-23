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

interface ShopItemListInterface extends ShopDependInterface
{
    /**
     * @param ShopItemPartList $itemPartList
     */
    public function addPart(ShopItemPartList $itemPartList): void;
}
