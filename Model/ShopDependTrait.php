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

trait ShopDependTrait
{
    /**
     * @var ShopInterface|null
     */
    protected $shop;

    /**
     * @return ShopInterface|null
     */
    public function getShop(): ?ShopInterface
    {
        return $this->shop;
    }

    /**
     * @param ShopInterface|null $shop
     */
    public function setShop(?ShopInterface $shop): void
    {
        $this->shop = $shop;
    }
}
