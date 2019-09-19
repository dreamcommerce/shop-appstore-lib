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

interface ShopDependInterface
{
    /**
     * @return ShopInterface|null
     */
    public function getShop(): ?ShopInterface;

    /**
     * @param ShopInterface|null $shop
     */
    public function setShop(?ShopInterface $shop): void;
}
